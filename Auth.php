<title>Authentication</title>
<head>

</head>

<body>
<div class = "logincontainer">
    <div id = "login">
        <h1>Вход</h1>
        <form action="loginform" method="post" name="loginform">
        <p><label for="user_login">Имя пользователя<br>
                <input class="input" id="username" name="username" size="20" type="text" value=""></label></p>
        <p><label for="user_pass">Пароль<br>
                <input class="input" id="password" name="password" size="20" type="password" value=""></label></p>
            <p class="submit"><input class="button" name="login" type="submit" value="Log in"></p>
            <p class="regtext">Еще не зарегестрированы? <a href ="register.php">Регистрация</a></p>
        </form>
    </div>
</div>
</body>
<?php

?>
