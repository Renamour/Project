<?php
require_once("bdpdo.php");


class User extends bdpdo
{

    private $table;

    function __construct($table)
    {
        parent::__construct();
        $this->table = $table;
    }

    function getUser($login)
    {
        $user = $this->select($this->table, "*", "WHERE login ='$login'");
        if (count($user) > 0) return $user;
        else return 0;
    }

    function AddUser($login, $password)
    {
        $this->insert($this->table, "id,login,password", " null ,'$login', '$password' ");

    }

    function AddFile($name1)
    {
        $this->insert($this->table, "id,pytu,users_id", "null,'$name1', '1' ");
    }

    function getFile()
    {
        $image = $this->sel($this->table, "pytu");

       return $image;
    }
}

$kk = new User('uppyt');
$userlog = new User("users");
