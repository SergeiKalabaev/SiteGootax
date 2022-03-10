<?php
$link = mysqli_connect("localhost","root","","testdb");

if(isset($_POST['submit']))
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
        mysqli_query($link,"INSERT INTO users SET user_login='".$login."', user_password = '".$password."'");
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
