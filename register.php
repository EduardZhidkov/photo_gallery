<?php
    session_start();
    if($_SESSION['user']){
        header('Location: profile.php');
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
    <script src="backend/function.js"></script>
    <title>Регистрация</title>
</head>
<body>

        <!--Форма регистрации-->

<form class="for_forms" action="backend/signup.php" method="post" enctype="multipart/form-data">
    <label>Регистрация</label>
    <input type="text"name="name" placeholder="Имя" pattern="(?=.*[Аа-яЁё]).{2,}"
           title="Допустимы только русские буквы пробелы и дефисы" required>
    <input type="text" name="login" placeholder="Логин" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" placeholder="Введите пароль" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
           title="Пароль должен содержать как минимум одну букву верхнего и нижнего регистра, минимальная длина – 6 символов"required>
    <input type="password" name="password_confirm" placeholder="Подтверждение пароля" required>
    <hr>
    <div class="check"> Принимаю пользовательское соглашение <input class="chec" type="checkbox" id="myCheck" onclick="check_of_consent()" style=""><br> </div>
    <button type="submit" id="submitbtn" style="display: none">Зарегистрироваться</button>

    <p>У вас уже есть аккаунт? - <a href="index.php">авторизуйтесь</a></p>

    <?php
    if($_SESSION['message']){
        echo '<p1 class="msg">' . $_SESSION['message'] . '</p1>';
    }
    unset($_SESSION['message']);
    ?>

</form>


</body>
</html>