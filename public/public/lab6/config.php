<?php
declare(strict_types=1);
session_start();

try {
    $conn = new PDO(
        'mysql:host=mysql;dbname=started;charset=utf8mb4',
        'started-user',
        'started-password'
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("БД не працює: " . $e->getMessage());
}

function need_login() {
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}
?>

