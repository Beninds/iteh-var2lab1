<?php
require "../connection.php";

$project = $_GET['project'];

$sqlSelect = "SELECT `time_start`,`time_end` FROM work where `FID_Projects` = :id";

$sth = $dbh->prepare($sqlSelect, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute(array(':id' => $project));

$totalTime = 0;
foreach ($sth as $index => $row) {
    $projectTime = strtotime($row['time_end']) - strtotime($row['time_start']);
    $totalTime += $projectTime;
}

echo "Общее время работы с проектом в формате Часы:Минуты:Секунды: <b>".date("H:i:s", mktime(0, 0, $totalTime))."<b>";
