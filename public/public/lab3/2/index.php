<?php
session_start();

$error_message = '';

if (isset($_SESSION['user_login'])) {
    header("Location: welcome.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {

    $valid_login = 'admin';
    $valid_password = '123';

    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login === $valid_login && $password === $valid_password) {

        $_SESSION['user_login'] = $login;

        $_SESSION['last_activity'] = time();

        header("Location: welcome.php");
        exit;
    } else {
        $error_message = "Неправильний логін або пароль!";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 2: Вхід</title>
</head>
<body>
<h1>Завдання 2: Вхід до системи</h1>

<form action="index.php" method="POST">
    <p>Введіть логін 'admin' та пароль '12345'</p>
    <div>
        <label for="login">Логін:</label>
        <input type="text" id="login" name="login" required>
    </div>
    <div>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <?php if ($error_message): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if (isset($_GET['timeout'])): ?>
        <p style="color: blue;">Сесію завершено через неактивність (5 хвилин).</p>
    <?php endif; ?>

    <button type="submit">Увійти</button>
</form>
<a href="../index.html">На головну</a>
</body>
</html>