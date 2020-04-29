<?php
    session_start();
    require_once 'connect.php';

    $name = $_POST['name'];
    $login = $_POST['login'];
    $email= $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    $query = 'select login from users 
    where login = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$login]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $ct = $stmt->rowCount();



if($ct > 0)
{
    $_SESSION['message'] = 'Такой логин уже существует!';
    header('Location: ../register.php');
}
else if($password != $password_confirm)
{
    $_SESSION['message'] = 'Пароли не совпадают!';
    header('Location: ../register.php');
}
else if($password === $password_confirm)
{
    $patch='uploads\avatar.png';
    $stmt = $connection->prepare('insert into users(login,password,email,name,avatar) values (?,?,?,?,?)');
    $stmt->execute([$login, md5($password), $email, $name,$patch]);
    $_SESSION['message'] = 'Регистрация прошла успешно!';
    header('Location: ../index.php');
}



