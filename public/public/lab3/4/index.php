<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['add_to_cart'])) {
    $item = $_POST['item'];
    $_SESSION['cart'][] = $item;
    header("Location: index.php");
    exit;
}

if (isset($_POST['checkout'])) {
    if (!empty($_SESSION['cart'])) {
        $past_purchases_json = json_encode($_SESSION['cart']);

        setcookie('past_purchases', $past_purchases_json, time() + (365 * 24 * 60 * 60), "/");

        $_SESSION['cart'] = [];
    }
    header("Location: index.php?checkout_success=1");
    exit;
}


$current_cart_items = $_SESSION['cart'];

$past_purchases_items = [];
if (isset($_COOKIE['past_purchases'])) {
    $past_purchases_items = json_decode($_COOKIE['past_purchases'], true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        $past_purchases_items = [];
    }
}

$products = ['Ноутбук', 'Миша', 'Клавіатура', 'Монітор'];

?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 4: Корзина</title>
</head>
<body>
<h1>Завдання 4: Корзина (SESSION + COOKIE)</h1>

<?php if (isset($_GET['checkout_success'])): ?>
    <p style="color: green;">Замовлення успішно оформлено! Ваша корзина збережена в cookie.</p>
<?php endif; ?>

<h2>Магазин</h2>
<?php foreach ($products as $product): ?>
    <form action="index.php" method="POST" style="display: inline-block; margin: 5px;">
        <input type="hidden" name="item" value="<?php echo htmlspecialchars($product); ?>">
        <button type="submit" name="add_to_cart">Додати "<?php echo htmlspecialchars($product); ?>"</button>
    </form>
<?php endforeach; ?>



<h2>Поточна корзина (збережено в $_SESSION)</h2>
<?php if (empty($current_cart_items)): ?>
    <p>Ваша корзина порожня.</p>
<?php else: ?>
    <ul>
        <?php foreach ($current_cart_items as $item): ?>
            <li><?php echo htmlspecialchars($item); ?></li>
        <?php endforeach; ?>
    </ul>
    <form action="index.php" method="POST">
        <button type="submit" name="checkout" style="background: green; color: white;">Оформити замовлення</button>
    </form>
<?php endif; ?>


<h2>Ваші минулі покупки (збережено в $_COOKIE)</h2>
<?php if (empty($past_purchases_items)): ?>
    <p>У вас немає збережених минулих покупок.</p>
<?php else: ?>
    <ul>
        <?php foreach ($past_purchases_items as $item): ?>
            <li><?php echo htmlspecialchars($item); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<a href="../index.html">На головну</a>
</body>
</html>