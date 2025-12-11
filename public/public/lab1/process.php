<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['firstname']);
    $surname = trim($_POST['lastname']);

    if (!empty($name) && !empty($surname)) {
        echo "Привіт, $name $surname!";
    } else {
        echo "Будь ласка, заповніть всі поля.";
    }
}
?>