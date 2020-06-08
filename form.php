<form action="index.php">
    <h1>Страничка</h1>
    <input type="submit" value="Загрузить">
</form>

<?php
$conn = mysqli_connect("localhost", "mysql", "", "datba");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!$conn) {
    die("Ошибка: " . mysqli_connect_error());
} else {
    $sqlr = ("SELECT id , content FROM  uploaded_text");
    $rest = mysqli_query($conn,$sqlr);
    while($roww = mysqli_fetch_array($rest)){
        $id = $roww['id'];
        $str = $roww['content'];
        echo "<p> ID: $id CONTENT: $str </p>";
    }
}
mysqli_close($conn);
?>