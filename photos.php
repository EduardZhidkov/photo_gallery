<?php

    session_start();
    require_once 'backend/connect.php';

    if(!$_SESSION['user'])
    {
        header('Location: /');
    }

    $way = $_GET['way'];
    //$login = $_SESSION['user']['login'];


    if(!empty($way))
    {
        $_SESSION['photo']['way']=$way;
    }



    $query = 'select photo_id, login, description
            from photos
            where photo_way = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$_SESSION['photo']['way']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $photo_id = $result['photo_id'];
    $_SESSION['photo']['photo_id']=$photo_id;
    $login = $result['login'];
    $description=$result['description'];


    $rating_array=array();
    $query = 'select rating_point
        from ratings
        where photo_id = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$photo_id]);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $count_personal_rating = $stmt->rowCount();
    if($count_personal_rating > 0){
        foreach ($result as $row){
            array_push($rating_array,$row['rating_point']);
        }
        $rating = array_sum($rating_array);
        $rating=$rating/$count_personal_rating;
    }


    $comments_array=array();
    $log_comments_array=array();
    $query = 'select comment_text, login
        from comments
        where photo_id = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$photo_id]);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if($count > 0){
        foreach ($result as $row){
            array_push($comments_array,$row['comment_text']);
            array_push($log_comments_array, $row['login']);
        }
    }


    for ($j=0; $j< count($log_comments_array); $j++) {
        $query = 'select name
            from users
            where login = ?';
        $stmt = $connection->prepare($query);
        $stmt->execute([$log_comments_array[$j]]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $name_comments_array[$j] = $result['name'];
    }


    $query = 'select name
            from users
            where login = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$login]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $name = $result['name'];


//    echo  $_SESSION['photo']['photo_id'];
    ?>

<!doctype html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main_profiles.css">
    <title>Фотография</title>
</head>


<body>


    <div class="menu">
        <a href="profile.php">Моя страница</a>
        <a href="add_photo.php">Добавить фотографию</a>
        <?php echo '<a href="gallery.php?login='. $_SESSION['user']['login'] .'">Моя галерея</a>'; ?>
        <a href="setting.php">Настройки</a>
        <a href="all_use.php">Все пользователи</a>
        <a href="backend/logout.php">Выход</a>
    </div>


    <div class="name">
        <h2><?=$name ?></h2>
    </div>

    <div class="photos">
        <img src="<?=$_SESSION['photo']['way']?>" class="collage_photo" height="" >
    </div>


    <div class="rating">
        <div class="number">
            <h2><?php echo round($rating,1);?></h2>
            <h3> <sub> <?php echo $count_personal_rating;?> </sub></h3>
        </div>
        <div class="assessment">
            <?php
                echo '<a href="backend/rating.php?number='. 1 .' &photo_id=' . $photo_id .'" >1</a>';
                echo '<a href="backend/rating.php?number='. 2 .' &photo_id=' . $photo_id .'" >2</a>';
                echo '<a href="backend/rating.php?number='. 3 .' &photo_id=' . $photo_id .'" >3</a>';
                echo '<a href="backend/rating.php?number='. 4 .' &photo_id=' . $photo_id .'" >4</a>';
                echo '<a href="backend/rating.php?number='. 5 .' &photo_id=' . $photo_id .'" >5</a>';
            ?>
        </div>
    </div>

    <?php
    if($_SESSION['message'])
    {
        echo '<div class="message"><p class="msg">' . $_SESSION['message'] . '</p> </div>';
    }
    unset($_SESSION['message']);
    ?>


    <div class="description">
        <?php
        if(!empty($description))
        {
            echo '<div class="com_description">'.$description.'</div>';
        }
        ?>
    </div>

    <form action="backend/add_comment.php" method="post" enctype="multipart/form-data" class="add_comment">
        <input type="text" name="comment" placeholder="Введите комментарий" required>
        <button class="but_add_com" type="submit">Добавить комментарий</button>
    </form>


    <div class="commenti">
        <?php
        if(count($comments_array) > 0)
        {
            for($i=0; $i< count($comments_array); $i++)
            {
                echo '<div class="c">';
                echo ' <div class="name_com"> <a href="profile_friends.php?login='.$log_comments_array[$i].'"> <h2> '.$name_comments_array[$i].' </h2> </a> </div>';
                echo '<div class="com">'.$comments_array[$i].'</div>';
                echo '</div>';
            }
        }
        else
        {
            echo '<div class="message">';
            echo 'Комментариев пока нет';
            echo '</div>';
        }
        ?>
    </div>




</body>