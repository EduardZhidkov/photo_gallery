<?php
    session_start();
    require_once ('backend/connect.php');

    $login=$_GET['login'];

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
    <title>Галерея</title>
</head>


<body>

<div class="menu">
    <a  href="profile.php">Моя страница</a>
    <a href="add_photo.php">Добавить фотографию</a>
    <?php echo '<a class="active" href="gallery.php?login='. $_SESSION['user']['login'] .'">Галерея</a>'; ?>
    <a href="setting.php">Настройки</a>
    <a href="all_use.php">Все пользователи</a>
    <a href="backend/logout.php">Выход</a>
</div>

    <div class="gallery_collage" style="">
        <?php
        if(count($photos_array) > 0)
        {
            foreach ($photos_array as $p)
            {
                echo '<a href="photos.php?way=' . $p . '"><img class ="gallery_collage_photo" src="' . $p . '" /></a>';
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