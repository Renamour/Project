<?php

$str = "Мело, мело по всей земле во все пределы. Свеча горела на столе, свеча горела. Как летом роем мошкара летит на пламя, слетались хлопья со двора к оконной раме. Метель лепила на стекле кружки и стрелы. Свеча горела на столе, свеча горела. На озаренный потолок ложились тени, скрещенья рук, скрещенья ног, судьбы скрещенья. И падали два башмачка со стуком на пол. И воск слезами с ночника на платье капал. И все терялось в снежной мгле седой и белой. Свеча горела на столе, свеча горела. На свечку дуло из угла, и жар соблазна вздымал, как ангел, два крыла крестообразно. Мело весь месяц в феврале, и то и дело свеча горела на столе, свеча горела. ";

$ste = mb_strtolower($str);//для перевода символов в нижний регистр
$r = [',', '.', '!', '?', null, false, '-'];
$ste = str_replace($r, " ", $ste);//для удаления мешающих нам символов
$result = mb_substr_count($str, ' ');//подсчет всего символов
$ar = explode(" ", $ste);//разбиение строк
$arr = ((array_count_values($ar)));// подсчет кол-ва значений

foreach ($arr as $key => $ar) {
    if ($key != "") {
        echo "{$key} : {$ar}\n";
    }
}
echo "Всего слов: ", $result;
