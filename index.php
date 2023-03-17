<?php
include 'iService.php';
include 'iPrice.php';
include 'Price.php';
include 'Base.php';
include 'Hours.php';
include 'Driver.php';
include 'GPS.php';
include 'Student.php';

$base = new Base(5, 60);
$base->additionalService(new GPS());
$base->additionalService(new Driver());
echo "Базовый тариф(5 километров, 60 минут) с водителем и GPS - " . $base->countPrice();

echo "</br>";

$student = new Student(3, 30);
echo "Студенческий тариф(3 километра, 30 минут) - " . $student->countPrice();

echo "</br>";

$hours = new Hours(6, 121);
echo "Часовой тариф (6 километров, 120 минут) - " . $hours->countPrice();