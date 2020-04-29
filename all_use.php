<?php
    session_start();
    require_once 'backend/connect.php';

    if(!$_SESSION['user'])
    {
        header('Location: /');
    }

    $all_use=array();
    $all_use_avatar=array();
    $all_use_name=array();
$query = 'select avatar, name
            from users
            where login != ? ';
    $stmt = $connection->prepare($query);
    $stmt -> execute([$_SESSION['user']['login']]);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    if(!empty($result)){
        foreach ($result as $row){
            array_push($all_use_avatar, $row['avatar']);
            array_push($all_use_name, $row['name']);

        }
    }


//    print_r($all_use);
//    print_r($all_use_avatar);


?>


<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main_profiles.css">
    <title>Профиль</title>
</head>


<body>

<div class="menu">
    <a  href="profile.php">Моя страница</a>
    <a href="add_photo.php">Добавить фотографию</a>
    <?php echo '<a href="gallery.php?login='. $_SESSION['user']['login'] .'">Галерея</a>'; ?>
    <a href="setting.php">Настройки</a>
    <a class="active" href="all_use.php">Все пользователи</a>
    <a href="backend/logout.php">Выход</a>
</div>


    <div class="users">
            <?php
            if(count($all_use_avatar) > 0)
            {
                for($i=0; $i< count($all_use_avatar); $i++)
                {
                    echo '<div class="all_use">';
                    echo '<div class="all_use_avatar" ><a href="profile_friends.php?way=' . $all_use_avatar[$i] . '"><img class ="profile_photo" src="' . $all_use_avatar[$i] . '" width="200px" /></a> </div>';
                    echo '<div class="all_use_name" ><a href="profile_friends.php?way=' . $all_use_avatar[$i] . '"> <h2> '.$all_use_name[$i] .' </h2></a></div>';
                    echo '</div>';
                }
            }
            else
            {
                $_SESSION['message'] = 'Дригих пользователй нет';
            }
            ?>
        </div>
</body>