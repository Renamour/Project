<?php

//var_dump( $_POST );

// Проверка загрузил ли пользователь файл
if (!empty ($_FILES['txt']['error'] == 0)) {
    $direkt = dirname(__FILE__) . '/' . $_FILES['txt']['name'];
    move_uploaded_file($_FILES['txt']['tmp_name'], $direkt);
    echo "Файл загружен <br/>";

    $f = $_FILES['txt']['name'];
    $t = file_get_contents($f);
    // Для видимости меняем кодировку
    $get = mb_detect_encoding($t, array('utf-8', 'cp1251'));
    $str = iconv($get, 'UTF-8', $t);
    echo "Найденный текст в файле: " . $str . "<br/>Разбор слов: <br/>";
    Printr($str);
    unlink($f);

} else {
    echo "Файл не был загружен<br/>";
}
echo "<br/>";

// Проверка ввел ли пользователь текст
if (!empty($_POST['text'])) {
    echo "Введеный текст: " . $_POST['text'] . "<br/>";
    $str = $_POST['text'];
    echo "Разбор слов: <br/>";
    Printr($str);
} else {
    echo "<br/>Текст не был введен";
}

function Printr($str)
{
    $str = mb_strtolower($str);
    $r = [',', '.', '!', null, '?', '-', false];
    $str = str_replace($r, " ", $str);
    $ar = explode(" ", $str);
    $arr = (array_count_values($ar));
    $result = count(explode(" ", $str));
    foreach ($arr as $key => $ar) {
        echo "{$key} : {$ar}" . "<br/>";
    }
    echo "Всего слов: ", $result;
    echo "<br/>";

    $dir = dirname(__FILE__) . '/' . 'gg/';
    // Для создания рандомных имён файла
    $name = (mt_rand(0, 1000)) . '.csv';
    while (file_exists($name)) $name = (mt_rand(0, 1000)) . '.csv';

    // Для записи в csv
    $fp = fopen($dir . $name, 'w');
    foreach ($arr as $field => $ar) {
        fputcsv($fp, explode(";", $field . ' : ' . $ar), ";");
    }
    fputcsv($fp, explode(";", 'Всего слов :' . $result));
    fclose($fp);
    // Для изменения кодировки (скорее всего не обязательно)
    $file_string = file_get_contents($dir . $name);
    $file_string = iconv("UTF-8", "WINDOWS-1251", $file_string);
    file_put_contents($dir . $name, $file_string);
}
