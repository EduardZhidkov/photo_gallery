<?php
    session_start();
    if($_SESSION['User']){
        header('Location:profile.php');
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
    <title>Авторизация</title>
</head>
<body>

        <!--Форма авторизации-->

    <form class="for_forms" action="backend/signin.php" method="post">
<!--        <p>Авторизация</p>-->
        <label> Логин </label>
        <input type="text" name="Login" placeholder="Введите логин">
        <button type = "submit"> Продолжить </button>
        <a href="register.php" >Зарегистрироваться</a>
        <?php
        if($_SESSION['message']){
            echo '<p class="msg">' . $_SESSION['message'] . '</p>';
        }
        unset($_SESSION['message']);
        ?>
    </form>


</body>
</html>