<?php

require_once("user.php") ;

if(isset($_POST['peg']))
{
    $login = $_POST['login'];
    $password = $_POST['password'];
    if($userlog->AddUser($login,$password))
    {
        echo "Ошибка регистрации!";
    }else{
        echo "<h1>Регистрация прошла успешно!Авторизуйтесь.</h1>";

    }
}

?>
 <li><a href="http://proj/index.php?">Главная</a></li>


