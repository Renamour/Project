<?php

class bdpdo
{

    public $pdo;

    function __construct($dbname = "register", $host = "localhost:3306", $user = "mysql", $pass = "")
    {
        $this->pdo = new PDO("mysql:dbname={$dbname};host={$host}", "{$user}", "{$pass}");
        return $this->pdo;

    }

    function insert($db, $cols = "", $values = "")
    {
        $res = $this->pdo->prepare("INSERT INTO {$db} ({$cols}) VALUES ({$values})");
        $res->execute();

    }


    function select($db, $cols, $where = "", $order = "", $limit = "")
    {

        $res = $this->pdo->prepare("SELECT {$cols} FROM `{$db}` {$where} {$order} {$limit}");
        $res->execute();
        if ($where != "") {
            $row = $res->fetchAll(pdo::FETCH_ASSOC);
            return $row;
        } else {
            $row = $res->fetchAll(pdo::FETCH_ASSOC);
            return $row;
        }
    }

    function sel($db, $cols)
    {
        $res = $this->pdo->prepare("SELECT {$cols} FROM {$db} ");
        $res->execute();
        while ($row = $res->fetch(pdo::FETCH_ASSOC)) {
            echo '<img width="400px" height="300px" src="' . $row[$cols] . '" />';
        }

    }
}








