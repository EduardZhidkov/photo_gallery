<?php
    session_start();
    require_once 'connect.php';

    $password = md5($_POST['Password']);


    $query = 'select * 
    from users as u
    where u.password = ? and u.login = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$password, $_SESSION['user']['login']]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();

    if($count > 0)
    {
        foreach ($result as $user)
        {
            $_SESSION['user'] = [
                'login' => $user['login'],
                'name' => $user['name'],
                'email' => $user['email'],
            ];
        }
        header('Location: ../profile.php');
    }
    else
    {
            $_SESSION['message'] = 'Неверный пароль!';
            header('Location: ../index2.php');
    }









