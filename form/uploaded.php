<?php
require_once ('user.php');

if (!empty ($_FILES['img']['error'] == 0)) {
    $direkt = dirname(__FILE__) . '/' . 'image/' . $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], $direkt);
    $img = $_FILES['img']['name'];
    echo "Файл загружен <br/>";
    $name = $_FILES['img']['name'];
    $name1 = 'image/' . $name;
    $kk->AddFile($name1);

}

?><p>Привет,чтобы просмотреть общий список изображений нажмите здесь <a href="prost.php">тык</a>.</p>









