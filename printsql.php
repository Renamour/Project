
<li><a href="http://Jouer/form.php?" title="Главная">Главная</a></li>

<?php
// Проверка ввода текста
if (!empty($_POST['text'])) {
    // echo "Введеный текст: " . $_POST['text'] . "<br/>";
    $str = $_POST['text'];
// Подключение к БД
    $conn = mysqli_connect("localhost", "mysql", "", "datba");
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $date = date('Y.m.d');
// Подсчет слов
    $str = mb_strtolower($str);
    $r = [',', '.', '!', null, '?', '-', false];
    $str = str_replace($r, " ", $str);
    $ar = explode(" ", $str);
    $arr = (array_count_values($ar));
    $result = count(explode(" ", $str));
    foreach ($arr as $key => $ar) {
        "{$key} : {$ar}" . "<br/>";
    }
    //echo "Всего слов: ", $result;

    if (!$conn) {
        die("Ошибка: " . mysqli_connect_error());
    } else {
        // echo "Подключено к БД <br>";
        $sql = "INSERT INTO uploaded_text (id, content, date, words_count) VALUES (null,'$str', '$date','$result')";
        $res = mysqli_query($conn, $sql);
        if ($res == false) {
            die("Ошибка: " . mysqli_connect_error());
        } else {

            $text_id = mysqli_insert_id($conn);
            foreach ($arr as $field => $ar) {
                $sql = "INSERT INTO word (id,text_id,word,count) VALUES (NULL,'$text_id','$field','$ar')";
                mysqli_query($conn, $sql);
            }

            $sqll = ("SELECT * FROM word , uploaded_text");
            $res = mysqli_query($conn, $sqll) or trigger_error(mysqli_error() . " in " . $sql);
            while ($row = mysqli_fetch_array($res)) {
                $id = $row['id'];
                $text_id = $row['text_id'];
                $field = $row['word'];
                $ar = $row['count'];
                $str = $row['content'];
                $date = $row['date'];
                $result = $row['words_count'];

                echo "<p> ID: $id TEXT_ID: $text_id WORD: $field COUNT: $ar <br>CONTENT: $str DATE: $date WORDS_COUNT: $result</p>";
            }
        }
    }
    mysqli_close($conn);
} else {
    echo "Текст не был введен";
}
?>