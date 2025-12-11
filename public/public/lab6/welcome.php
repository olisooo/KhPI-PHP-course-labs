<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Ласкаво просимо</title></head>
<body>
<h2>Ласкаво просимо, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
<p>Ви успішно увійшли в систему.</p>
<a href="logout.php">Вихід</a>
</body>
</html>