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

echo "<h2>Тест 1: Робота з BankAccount</h2>";

try {
    $myAccount = new BankAccount("USD", 100);
    echo "Початковий баланс: " . $myAccount->getBalance() . "<br>";

    $myAccount->deposit(50);
    echo "Баланс: " . $myAccount->getBalance() . "<br>";

    $myAccount->withdraw(30);
    echo "Баланс після зняття: " . $myAccount->getBalance() . "<br>";

    echo "<b>Спроба зняти 1000 USD:</b><br>";
    $myAccount->withdraw(1000);

} catch (Exception $e) {
    echo "Виняток спіймано: " . $e->getMessage() . "<br>";
}

echo "<h2>Тест 2: Робота з SavingsAccount</h2>";

try {
    SavingsAccount::$interestRate = 0.10;

    $savings = new SavingsAccount("EUR", 500);
    echo "Депозитний баланс: " . $savings->getBalance() . "<br>";

    $savings->applyInterest();
    echo "Баланс після відсотків: " . $savings->getBalance() . "<br>";

    echo "<b>Спроба поповнити на -100 EUR:</b><br>";
    $savings->deposit(-100);

} catch (Exception $e) {
    echo "Виняток спіймано: " . $e->getMessage() . "<br>";
}
?>

