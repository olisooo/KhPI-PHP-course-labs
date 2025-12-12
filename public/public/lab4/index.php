<?php

class Product {
    public string $name;
    protected float $price;
    public string $description;

    function __construct(string $name, float $price, string $description) {
        if ($price < 0) {
            // Перевірка на від'ємну ціну
            throw new InvalidArgumentException("Ціна не може бути від'ємною");
        }
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }

    public function getInfo(): string {
        return "<br>Назва: {$this->name}<br>
       Ціна: {$this->price} грн<br>
       Опис: {$this->description}<br>";
    }
}

class DiscountedProduct extends Product {
    public float $discount;

    function __construct(string $name, float $price, string $description, float $discount) {
        // Виклик конструктора батьківського класу
        parent::__construct($name, $price, $description);
        $this->discount = $discount;
    }

    public function getDiscounted() : float {
        return $this->price * (1 - $this->discount / 100);
    }

    public function getInfo() : string {
        return parent::getInfo() .
            "Знижка: " . $this->discount . "%<br>" .
            "Нова ціна: " . $this->getDiscounted() . " грн<br>";
    }

}

$product1 = new Product("Ноутбук Dell XPS 13", 45000.00, "16GB RAM, i7 12th Gen");
$product2 = new Product("Монітор LG UltraFine", 15500.00, "27 дюймів, 4K");

$discountedProduct1 = new DiscountedProduct("Клавіатура Logitech MX", 3200.00, "Механічна, бездротова", 15);
$discountedProduct2 = new DiscountedProduct("Миша Razer DeathAdder", 1800.00, "Ігрова, 20000 DPI", 30);


echo "<h2>Тестування окремих товарів</h2>";
echo "Товар:" . $product1->getInfo() . "<br>";
echo "Товар:" . $product2->getInfo() . "<br>";
echo "Товар зі знижкою:" . $discountedProduct1->getInfo() . "<br>";
echo "Товар зі знижкою:" . $discountedProduct2->getInfo() . "<br>";

class Category
{
    public string $name;
    public array $products;

    public function __construct(string $name) {
        $this->name = $name;
        $this->products = [];
    }

    public function addProduct(Product $product) : void {
        $this->products[] = $product;
    }

    public function getInfo(): string {
        $info = "<h2>Категорія: {$this->name}</h2>";
        $info .= "<h3>Список товарів:</h3>";

        foreach ($this->products as $product) {
            $info .= $product->getInfo();
        }
        return $info;
    }
}

$category = new Category("Комп'ютерна техніка");
$category->addProduct($product1);
$category->addProduct($product2); // Додаємо звичайний товар
$category->addProduct($discountedProduct1); // Додаємо товар зі знижкою

echo $category->getInfo();

$discountCategory = new Category("Акційні пропозиції");
$discountCategory->addProduct($discountedProduct1);
$discountCategory->addProduct($discountedProduct2);

echo $discountCategory->getInfo();
?>
