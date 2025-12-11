<?php

interface AccountInterface {
    public function deposit($amount);
    public function withdraw($amount);
    public function getBalance();
}

class BankAccount implements AccountInterface {
    const MIN_BALANCE = 0;

    protected $balance;
    protected $currency;

    public function __construct($currency, $initialBalance = 0) {
        $this->currency = $currency;
        $this->balance = $initialBalance;
    }

    public function getBalance() {
        return $this->balance . " " . $this->currency;
    }

    public function deposit($amount) {
        if ($amount < 0) {
            throw new Exception("Помилка: Сума поповнення не може бути від'ємною.");
        }
        $this->balance += $amount;
        echo "Поповнено: $amount {$this->currency}.<br>";
    }

    public function withdraw($amount) {
        if ($amount < 0) {
            throw new Exception("Помилка: Сума зняття не може бути від'ємною.");
        }

        if (($this->balance - $amount) < self::MIN_BALANCE) {
            throw new Exception("Недостатньо коштів. Поточний баланс: {$this->getBalance()}.");
        }

        $this->balance -= $amount;
        echo "Знято: $amount {$this->currency}.<br>";
    }
}

class SavingsAccount extends BankAccount {
    public static $interestRate = 0.05;

    public function applyInterest() {
        $interest = $this->balance * self::$interestRate;
        $this->balance += $interest;
        echo "Нараховано відсотки (" . (self::$interestRate * 100) . "%): +$interest {$this->currency}.<br>";
    }
}

echo "<h2>Тест 1: Звичайний рахунок</h2>";

try {
    $account = new BankAccount("USD", 100);
    echo "Початковий баланс: " . $account->getBalance() . "<br>";

    $account->deposit(50);
    echo "Баланс після поповнення: " . $account->getBalance() . "<br>";

    $account->withdraw(30);
    echo "Баланс після зняття: " . $account->getBalance() . "<br>";

    echo "<b>Спроба зняти 1000 USD:</b><br>";
    $account->withdraw(1000);

} catch (Exception $e) {
    echo "Спіймано виняток: " . $e->getMessage() . "<br>";
}

echo "<h2>Тест 2: Накопичувальний рахунок</h2>";

try {
    $savings = new SavingsAccount("EUR", 2000);
    echo "Початковий баланс: " . $savings->getBalance() . "<br>";

    $savings->applyInterest();
    echo "Баланс після нарахування відсотків: " . $savings->getBalance() . "<br>";

    echo "<b>Спроба поповнити на -100 EUR:</b><br>";
    $savings->deposit(-100);

} catch (Exception $e) {
    echo "Спіймано виняток: " . $e->getMessage() . "<br>";
}
?>

