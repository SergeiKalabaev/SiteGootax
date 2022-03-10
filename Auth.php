<title>Authentication</title>
<?php include ("includes/header.php");?>

<div class = "container-md">
    <div id = "login">
        <h1>Вход</h1>
        <form action="Auth.php" method="post" name="loginform">
        <p><label for="user_login">Имя пользователя<br>
                <input class="input" id="login" name="login" size="20" type="text" value=""></label></p>
        <p><label for="user_pass">Пароль<br>
                <input class="input" id="password" name="password" size="20" type="password" value=""></label></p>
            <p class="submit"><input class="button" id="button" name="submit" type="submit" value="Log in"></p>
            <p class="regtext">Еще не зарегистрированы? <a href ="registration.php">Регистрация</a></p>
        </form>
    </div>
</div>

<?php

function generateCode($length=6)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code="";
    $clen = strlen($chars) - 1;
    while (strlen($code)<$length)
    {
        $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}
$link = mysqli_connect("localhost","root","","testdb");
    if (isset($_POST['submit']))
    {
        $query = mysqli_query($link, "SELECT user_id, user_password FROM users WHERE user_login ='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
        $data = mysqli_fetch_assoc($query);

        if($data['user_password']===md5(md5($_POST['password'])))
        {
            $hash = md5(generateCode(10));

            setcookie("id",$data['user_id'],time()+60*60*24*30, "/");
            header("Location: index.php");

        }
        else
        {
            print ("<b>Вы ввели неправильный логин или пароль</b><br>");
        }
    }
?>
<?php include ("includes/footer.php");?>

