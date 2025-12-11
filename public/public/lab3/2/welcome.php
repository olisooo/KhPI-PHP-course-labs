<?php
session_start();
$session_timeout = 5 * 60;

if (isset($_SESSION['last_activity'])) {
    if ((time() - $_SESSION['last_activity']) > $session_timeout) {
        session_unset();
        session_destroy();
        header("Location: index.php?timeout=1");
        exit;
    } else {
        $_SESSION['last_activity'] = time();
    }
}

if (!isset($_SESSION['user_login'])) {
    header("Location: index.php");
    exit;
}

$user = htmlspecialchars($_SESSION['user_login']);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Приватна сторінка</title>
</head>
<body>
<h1>Вітаємо, <?php echo $user; ?>!</h1>
<p>Ви успішно увійшли в систему.</p>
<p>Ваша сесія буде автоматично завершена через 5 хвилин неактивності (Завдання 5).</p>

<form action="logout.php" method="POST">
    <button type="submit">Вихід</button>
</form>

<hr>
<a href="../index.html">На головну</a>
</body>
</html>