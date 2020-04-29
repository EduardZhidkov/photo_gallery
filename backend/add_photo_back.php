<?php
session_start();
require_once ('connect.php');

$login = $_SESSION['user']['login'];
$photo_pub_date = date("d.m.Y");
$photo_way = 'uploads/' . time() . $_FILES['add_photo']['name'];
if(!move_uploaded_file($_FILES['add_photo']['tmp_name'],'../'. $photo_way)){
    $_SESSION['message'] = 'Ошибка при загрузки изображения!';
    header('Location: profile.php');
    exit();
}

$stmt = $connection->prepare('insert into photos(login,photo_way) values (?,?)');
$stmt->execute([$login, $photo_way]);
header('Location: ../profile.php');
?>