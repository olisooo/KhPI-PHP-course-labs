<?php
// Завдання 1
echo "Hello, World!<br>"; // Вивід рядку на екран

// Завдання 2
$stringVar = "Студент";
$intVar = 20;
$floatVar = 85.5;
$boolVar = true;

echo "string: $stringVar, int: $intVar, float: $floatVar<br>";
var_dump($stringVar); echo "<br>";
var_dump($intVar); echo "<br>";
var_dump($floatVar); echo "<br>";
var_dump($boolVar); echo "<br>";

// Завдання 3
$str1 = "Лабораторна";
$str2 = "робота 1";
echo $str1 . " " . $str2 . "<br>";

// Завдання 4
$number = 42;
if ($number % 2 == 0) {
    echo "Число $number є парним.<br>";
} else {
    echo "Число $number є непарним.<br>";
}

// Завдання 5
for ($i = 1; $i <= 10; $i++) { echo "$i "; }
echo "<br>";
$j = 10;
while ($j >= 1) { echo "$j "; $j--; }
echo "<br>";

// Завдання 6
$student = [
    "name" => "Ivan",
    "surname" => "Petrov",
    "age" => 20,
    "major" => "Computer Science"
];

foreach ($student as $key => $value) {
    echo "$key: $value<br>";
}

$student["avg_score"] = 95.5;
print_r($student);
?>

