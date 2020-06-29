<?php

require_once("user.php");


if(isset($_POST['avt']))
{
    $login = $_POST['login'];
    $password = $_POST['password'];

    $user = $userlog->getUser($login);

    if($user!=0)
    {

        if($password ==$user[0]['password']){
           // echo "Вход в систему завершен!";
            require ("upimg.php");

        }else{
            echo "Неправильный логин или пароль";
            echo "<li><a href='http://proj/index.php?'>Главная</a></li>";
        }
    } else {
        echo "Такой пользователь не найден";
        echo "<li><a href='http://proj/index.php?'>Главная</a></li>";
    }
}


