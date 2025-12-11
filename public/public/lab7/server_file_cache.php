<?php
$cache_dir = 'cache/';
$cache_file = $cache_dir . 'report.html';
$cache_time_limit = 600;
$generation_delay = 3;

if (file_exists($cache_file) && (time() - filemtime($cache_file) < $cache_time_limit)) {
    $content = file_get_contents($cache_file);
    $source = 'З кеш-файлу (' . $cache_file . ')';
} else {
    sleep($generation_delay);

    ob_start();

    echo "<h1>Сформовано новий звіт</h1>";
    echo "<p>Час генерації: " . date('H:i:s') . "</p>";
    echo "<table><thead><tr><th>#</th><th>Ім'я</th><th>Сума</th></tr></thead><tbody>";
    for ($i = 1; $i <= 1000; $i++) {
        echo "<tr><td>{$i}</td><td>Користувач". $i ."</td><td>" . rand(100, 9999) . " UAH</td></tr>";
    }
    echo "</tbody></table>";

    //вмісту буфера у змінну
    $content = ob_get_clean();
    $source = 'Створено новий кеш';

    file_put_contents($cache_file, $content);
}

echo $content;
echo "Джерело даних: " . $source . " (Затримка: " . $generation_delay . " сек)</p>";