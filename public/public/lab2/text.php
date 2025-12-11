<?php
$logFile = 'log.txt';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['logText'])) {
    $text = $_POST['logText'] . PHP_EOL;
    file_put_contents($logFile, $text, FILE_APPEND); // Запис у файл [cite: 116]
}

if (file_exists($logFile)) {
    echo "<h3>Вміст log.txt:</h3>";
    echo nl2br(file_get_contents($logFile));
}
?>

