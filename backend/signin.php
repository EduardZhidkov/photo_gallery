<?php
    session_start();
    require_once 'connect.php';

    $login = $_POST['Login'];

    $query = 'select * 
    from users as u
    where u.login = ? ';

    $stmt = $connection->prepare($query);
    $stmt->execute([$login]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();


    if($count > 0)
    {
        foreach ($result as $user)
        {
            $_SESSION['user'] =
            [
                'login' => $user['login'],
            ];
        }
        header('Location: ../index2.php');
    }
    else
    {
        $_SESSION['message'] = 'Неверный логин!';
        header('Location: ../index.php');
    }











