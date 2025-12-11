<?php
if (isset($_POST['username']) && !empty($_POST['username'])) {
    $username = $_POST['username'];
    setcookie('username', $username, time() + (7 * 24 * 60 * 60), "/");
    header("Location: index.php");
    exit;
}

if (isset($_POST['delete_cookie'])) {
    setcookie('username', '', time() - 3600, "/");

    header("Location: index.php");
    exit;
}

$current_user = null;
if (isset($_COOKIE['username'])) {
    $current_user = htmlspecialchars($_COOKIE['username']);
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 1: $_COOKIE</title>
</head>
<body>
<h1>Завдання 1: Робота з $_COOKIE</h1>

<?php if ($current_user): ?>
    <h2>Вітаємо, <?php echo $current_user; ?>!</h2>
    <p>Ваше ім'я було збережено в $_COOKIE.</p>

    <form action="index.php" method="POST">
        <input type="hidden" name="delete_cookie" value="1">
        <button type="submit">Видалити ім'я (cookie)</button>
    </form>

<?php else: ?>
    <h2>Введіть ваше ім'я</h2>
    <p>Воно буде збережено в cookie на 7 днів.</p>

    <form action="index.php" method="POST">
        <label for="username">Ім'я:</label>
        <input type="text" id="username" name="username" required>
        <button type="submit">Зберегти</button>
    </form>
<?php endif; ?>

<a href="../index.html">На головну</a>
</body>
</html>