<?php
    session_start();
    require_once ('connect.php');

    if(!$_SESSION['user'])
    {
        header('Location: /');
    }

    $number = $_GET['number'];
//    echo $number;
//    echo $_SESSION['photo']['photo_id'];


//узнаем логин пользователя чья фотография, чтобы не оценить свою
    $query = 'select login
                from photos
                where photo_way = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$_SESSION['photo']['way']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $login = $result['login'];
//    echo $login;
//    echo $_SESSION['photo']['photo_id'];

    $query = 'select rating_id
            from ratings
            where photo_id = ? AND login = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$_SESSION['photo']['photo_id'], $_SESSION['user']['login']]);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $result = $stmt->rowCount();
//    echo $result;

    if($login==$_SESSION['user']['login'])
    {
        $_SESSION['message'] = 'Себе оценку ставить нельзя!';
        header('Location: ../photos.php');
        exit();
    }

    if($result > 0  && $login!=$_SESSION['user']['login']){
        $stmt = $connection->prepare('update ratings
            set rating_point = ?
            where photo_id = ? and login = ?');
        $stmt->execute([ $number, $_SESSION['photo']['photo_id'],$_SESSION['user']['login']]);
        $_SESSION['message'] = 'Вы изменили оценку!';
//        echo 'зашел в изменение';
    }
    else if ($result < 1  && $login!=$_SESSION['user']['login']){

        $stmt = $connection->prepare('insert into ratings(login, photo_id, rating_point) values (?,?,?)');
        $stmt->execute([$_SESSION['user']['login'], $_SESSION['photo']['photo_id'], $number]);
        $_SESSION['message'] = 'Спасибо за оценку!';
//        echo 'зашел в добавление';
    }

    header('Location: ../photos.php');