<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.html");
    exit;
}

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Інформація про сервер</title>
    <style>
        table { border-collapse: collapse; width: 80%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
        code { background: #eee; padding: 2px 5px; }
    </style>
</head>
<body>
<h1>Завдання 3: Інформація з $_SERVER</h1>
<p>Ви успішно надіслали POST-запит.</p>

<table>
    <tr>
        <th>Змінна $_SERVER</th>
        <th>Значення</th>
    </tr>
    <tr>
        <td><code>$_SERVER['REMOTE_ADDR']</code> (IP-адреса клієнта)</td>
        <td><?php echo htmlspecialchars($_SERVER['REMOTE_ADDR']); ?></td>
    </tr>
    <tr>
        <td><code>$_SERVER['HTTP_USER_AGENT']</code> (Браузер)</td>
        <td><?php echo htmlspecialchars($_SERVER['HTTP_USER_AGENT']); ?></td>
    </tr>
    <tr>
        <td><code>$_SERVER['PHP_SELF']</code> (Назва скрипта)</td>
        <td><?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?></td>
    </tr>
    <tr>
        <td><code>$_SERVER['REQUEST_METHOD']</code> (Метод запиту)</td>
        <td><?php echo htmlspecialchars($_SERVER['REQUEST_METHOD']); ?></td>
    </tr>
    <tr>
        <td><code>$_SERVER['SCRIPT_FILENAME']</code> (Шлях до файлу на сервері)</td>
        <td><?php echo htmlspecialchars($_SERVER['SCRIPT_FILENAME']); ?></td>
    </tr>
</table>

<hr>
<a href="index.html">Назад до форми</a><br>
<a href="../index.html">На головну</a>
</body>
</html>