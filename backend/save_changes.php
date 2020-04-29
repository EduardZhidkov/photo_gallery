<?php
    session_start();
    require_once 'connect.php';

    $email= $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $avatar=$_FILES['avatar']['name'];
    $photo=$_FILES['photo']['name'];
    $description=$_POST['description'];

    if (!empty($_POST['password']))
    {
        if($password === $password_confirm)
        {
            $stmt = $connection->prepare('update users
                                                    set password = ?
                                                    where  login = ?');
            $stmt->execute([md5($password), $_SESSION['user']['login']]);

        }
        else {
            $_SESSION['message']= 'Пароли не совпадают!';
            header('Location: ../setting.php');
            exit();
        }

    }



    if (!empty($_POST['email']))
    {
        $stmt = $connection->prepare('update users
        set email= ?
        where  login = ?');
        $stmt->execute([$email,$_SESSION['user']['login']]);
        $_SESSION['user']['email']=$email;

    }

    if (!empty($avatar))
    {
        $photo_end= end(explode(".", $_FILES['avatar']['name']));
        $photo_way='uploads/'. time() .$_FILES['avatar']['name'];
        if($photo_end=='jpg' ) {
            if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $photo_way)) {
                $_SESSION['message'] = 'Ошибка при загрузке изображения';
                header('Location: ../setting.php');
                exit();
            }
            $stmt = $connection->prepare('update users
                    set avatar= ?
                    where  login = ?');
            $stmt->execute([$photo_way, $_SESSION['user']['login']]);
        }
        else{
            $_SESSION['message']='Файл имеет неправильное расширение';
            header('Location: ../setting.php');
            exit();
        }
    }

//    echo $photo;
    if(!empty($photo))
    {
        $photo_end= end(explode(".", $_FILES['photo']['name']));
        $photo_way = 'uploads/' . time() . $_FILES['photo']['name'];
        if($photo_end=='jpg' ) {
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $photo_way)) {
                $_SESSION['message'] = 'Ошибка при загрузки изображения!';
                header('Location: ../add_photo.php');
//                echo 'зашел но не загрузил';
                exit();
            }
            $stmt = $connection->prepare('insert into photos(login,photo_way, description) values (?,?,?)');
            $stmt->execute([$_SESSION['user']['login'], $photo_way, $description]);
        }
        else{
            $_SESSION['message']='Файл имеет неправильное расширение';
            header('Location: ../add_photo.php');
//            echo 'неправильный формат   ';
            exit();
        }
    }


    header('Location: ../profile.php');

?>



