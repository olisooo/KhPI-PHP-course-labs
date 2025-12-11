<?php
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) mkdir($uploadDir);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['uploadedFile'])) {
    $file = $_FILES['uploadedFile'];

    if (is_uploaded_file($file['tmp_name'])) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $maxSize = 2 * 1024 * 1024; // 2 MB [cite: 105]

        if (in_array($file['type'], $allowedTypes) && $file['size'] <= $maxSize) {
            $fileName = basename($file['name']);
            $targetPath = $uploadDir . $fileName;

            if (file_exists($targetPath)) {
                $fileName = time() . "_" . $fileName;
                $targetPath = $uploadDir . $fileName;
                echo "Файл з таким ім'ям існує. Нове ім'я: $fileName<br>";
            }

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                echo "Файл успішно завантажено.<br>";
                echo "Ім'я: $fileName<br>";
                echo "Тип: " . $file['type'] . "<br>";
                echo "Розмір: " . round($file['size'] / 1024, 2) . " KB<br>";
                echo "<a href='$targetPath' download>Завантажити файл назад</a>";
            }
        } else {
            echo "Помилка: Дозволені тільки зображення (png, jpg) до 2 МБ.";
        }
    } else {
        echo "Помилка завантаження.";
    }
}
?>