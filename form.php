<form action="index.php">
    <h1>Страничка</h1>
    <input type="submit" value="Загрузить">
</form>

<?php
$pdo = new  PDO('mysql:dbname=datba;host=localhost:3306', 'mysql', '');
$sqle = $pdo->prepare("SELECT id,content from uploaded_text ");
$sqle->execute();
while ($roww = $sqle->fetch(PDO::FETCH_LAZY)) {

    $id = $roww['id'];
    $str = $roww['content'];
    echo "<p> ID: $id CONTENT: $str </p>";

}
$pdo = null;
?>

