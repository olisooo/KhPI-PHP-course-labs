<?php
$dir = 'uploads/';
if (is_dir($dir)) {
    $files = scandir($dir);
    echo "<h3>Файли у папці uploads:</h3>";
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            echo "<a href='$dir$file' download>$file</a><br>"; // Посилання для завантаження [cite: 120]
        }
    }
}
?>

