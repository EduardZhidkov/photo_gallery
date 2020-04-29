<?php
    session_start();
    require_once ('connect.php');

    if(!$_SESSION['user'])
    {
        header('Location: /');
    }

    $comment = $_POST['comment'];

    if(!empty($comment)){
        header('Location: ../photos.php');
    }


//    echo $comment;
//    echo $_SESSION['photo']['photo_id'];
//    echo $_SESSION['user']['login'];


    $stmt = $connection->prepare('insert into comments(login,photo_id, comment_text) values (?,?,?)');
    $stmt->execute([$_SESSION['user']['login'], $_SESSION['photo']['photo_id'], $comment,]);
    header('Location: ../photos.php');

?>