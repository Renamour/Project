
<li><a href="http://Jouer/form.php?" title="Главная">Главная</a></li>

<?php
// Проверка ввода текста
if (!empty($_POST['text'])) {
    // echo "Введеный текст: " . $_POST['text'] . "<br/>";
    $str = $_POST['text'];
// Подключение к БД

    $pdo = new  PDO('mysql:dbname=datba;host=localhost:3306', 'mysql', '');

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


    $sql1 = $pdo->prepare("INSERT INTO uploaded_text (id, content, date, words_count) VALUES (null,'$str', '$date','$result')");
    $sql1->execute();

    $text_id = $pdo->lastInsertId();
    foreach ($arr as $field => $ar) {
        $sql2 = $pdo->prepare("INSERT INTO word (id,text_id,word,count) VALUES (NULL,'$text_id','$field','$ar')");
        $sql2->execute();

    }

    $sql3 = $pdo->prepare("SELECT * FROM word , uploaded_text");
    $sql3->execute();
    while ($row = $sql3->fetch(PDO::FETCH_ASSOC)) {

        $id = $row['id'];
        $text_id = $row['text_id'];
        $field = $row['word'];
        $ar = $row['count'];
        $str = $row['content'];
        $date = $row['date'];
        $result = $row['words_count'];
        echo "<p> ID: $id TEXT_ID: $text_id WORD: $field COUNT: $ar <br>CONTENT: $str DATE: $date WORDS_COUNT: $result</p>";

    }
    $pdo = null;

} else {
    echo "Текст не был введен";
}
?>