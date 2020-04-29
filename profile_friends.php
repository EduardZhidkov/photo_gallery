<?php
    session_start();
    require_once ('backend/connect.php');

    if(!$_SESSION['user'])
    {
        header('Location: index.php');
    }


    $login = $_GET['login'];

    if($login===$_SESSION['user']['login'])
    {
        //header('Location: profile.php');
    }



    $way = $_GET['way'];

    if(!empty($login)) {
        $query = 'select avatar
                    from users 
                    where login = ?';
        $stmt = $connection->prepare($query);
        $stmt->execute([$login]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $way = $result['avatar'];
    }

    if(!empty($way))
    {
        $_SESSION['photo']['way'] = $way;
    }


    $query = 'select login, name
                from users 
                where avatar = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$_SESSION['photo']['way']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $login = $result['login'];
    $name = $result['name'];

    if($_SESSION['user']['login']===$login)
    {
        header('Location: profile.php');
    }

    $photos_array=array();
    $query = 'select photo_way
        from photos
        where login = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$login]);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if($count > 0){
        foreach ($result as $row){
            array_push($photos_array,$row['photo_way']);
        }
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main_profiles.css">
    <title>Друзья</title>
</head>


<body>

    <div class="menu">
        <a href="profile.php">Моя страница</a>
        <a href="add_photo.php">Добавить фотографию</a>
        <?php echo '<a href="gallery.php?login='. $login .'">Галерея друга</a>'; ?>
        <a href="setting.php">Настройки</a>
        <a href="all_use.php">Все пользователи</a>
        <a href="backend/logout.php">Выход</a>
    </div>

    <div class="avatar">
        <img src="<?=$_SESSION['photo']['way']?>" class="photografi" height="" width="">
        <h2><?=$name ?></h2>
    </div>


    <div class="collage" style="">
        <?php
        if(count($photos_array) > 0)
        {
            foreach ($photos_array as $pa)
            {
                echo '<a href="photos.php?way=' . $pa . '"><img class ="collage_photo" src="' . $pa . '" width="200px" /></a>';
            }
        }
        else
        {
            $_SESSION['message'] = 'Публикаций пока нет';
        }
        ?>
    </div>


    <?php
    if($_SESSION['message'])
    {
        echo '<p class="msg">' . $_SESSION['message'] . '</p>';
    }
    unset($_SESSION['message']);
    ?>



</body>