<?php
    session_start();
    require_once ('backend/connect.php');
    if(!$_SESSION['user'])
    {
        header('Location: /');
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main_profiles.css">
    <title>Добавление фотографии</title>
</head>
<body>

    <div class="menu">
        <a href="profile.php">Моя страница</a>
        <a class="active" href="add_photo.php">Добавить фотографию</a>
        <?php echo '<a href="gallery.php?login='. $_SESSION['user']['login'] .'">Галерея</a>'; ?>
        <a href="setting.php">Настройки</a>
        <a href="all_use.php">Все пользователи</a>
        <a href="backend/logout.php">Выход</a>
    </div>

    <form action="backend/save_changes.php" method="post" enctype="multipart/form-data" class="for_forms">
        <label>Добавить фотографию</label>
        <input type="file" name="photo" required>
        <?php
        if($_SESSION['message'])
        {
            echo '<p class="msg">' . $_SESSION['message'] . '</p>';
        }
        unset($_SESSION['message']);
        ?>
        <label>Описание</label>
        <input type="text" name="description" placeholder="Опишите фотографию" required>
        <button type="submit">Сохранить изменения</button>
    </form>


</body>
