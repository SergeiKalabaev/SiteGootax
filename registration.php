<title>Registration</title>
<?php include ("includes/header.php");?>

<div class="container-md">
    <div id="login">
        <h1>Регистрация</h1>
        <form action="registration.php" id="registerform" method="post" name="registerform">
            <p><label for="user_login">Полное имя<br>
                    <input class="input" id="full_name" name="full_name" size="32" type="text" value=""></label></p>
            <p><label for="user_pass">E-mail<br>
                    <input class="input" id="email" name="email" size="32" type="email" value=""></label></p>
            <p><label for="user_pass">Имя пользователя<br>
                    <input class="input" id="user_login" name="login" size="32" type="text" value=""></label></p>
            <p><label for="user_pass">Пароль<br>
                    <input class="input" id="password" name="password" size="32" type="password" value=""></label></p>
            <p class="submit"><input class="button" id="register" name="register"   type="submit" value="Зарегистрироваться"></p>
            <p class="regtext">Уже зарегистрированы? <a href="auth.php">Введите имя пользователя</a></p>

 <?php
            $link = mysqli_connect("localhost","root","","testdb");

            if(isset($_POST['register']))
            {
                $err=[];
                if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
                {
                    $err[]="Логин может быть только из букв английского алфавита и цифр";
                }
                if(strlen($_POST['login'])< 3 or strlen($_POST['login']) > 30)
                {
                    $err[] = "Логин должен быть размером от 3 до 30 символов";
                }
                $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");
                if(mysqli_num_rows($query) > 0)
                {
                    $err[]="Пользователь с таким логином уже существует в базе данных";
                }
                if(count($err)==0)
                {
                    $login = $_POST['login'];
                    $password =md5(md5(trim($_POST['password'])));
                    $fullname=$_POST['full_name'];
                    $email = $_POST['email'];
                    mysqli_query($link,"INSERT INTO users SET user_login='".$login."', user_password = '".$password."', user_fullname='".$fullname."', user_email='".$email."'");
                    print ("Успешная регистрация");
                }
                else {
                    print "<b>При регистрации произошли следующие ошибки:</b><br>";
                    foreach ($err AS $error)
                    {
                        print $error."<br>";
                    }
                }
            }
?>

<?php include ("includes/footer.php");?>
