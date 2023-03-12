<?php
include "Interfaces.php";

abstract class Price implements iPrice{

    public $kiloms;
    public $minutes;
    public $perKilom;
    public $perMinute;
    private $services;
    public $result;
    public function __construct($kiloms, $minutes){
        $this->kiloms = $kiloms;
        $this->minutes = $minutes;
    }

    public function countPrice()
    {
        $result = $this->kiloms * $this->perKilom + $this->minutes * $this->perMinute;

        if($this->services){
            foreach ($this->services as $value){
                $value->addServiceToPrice($this, $result);
            }
        }

        return $result;
    }

    public function additionalService(iService $service)
    {
        $this->services[] = $service;
    }
    public function getMinutes(){
        return $this->minutes;
    }
    public function getKiloms(){
        return $this->kiloms;
    }
}

class Base extends Price{
    public $perKilom = 10;
    public $perMinute = 3;
}

class Student extends Price{
    public $perKilom = 4;
    public $perMinute = 1;
}
class Hours extends Price{
    public $perKilom = 0;
    public $perMinute = 200/60;

    public function __construct($kiloms, $minutes)
    {
        parent::__construct($kiloms, $minutes);
        if ($this->minutes < 60){
            $this->minutes = 60;
        }
        else{
            $this->minutes = (ceil($this->minutes/60) * 60);
        }
    }
}

class GPS implements iService{

    public function addServiceToPrice(iPrice $price, &$result)
    {
        $hours = ceil($price->getMinutes()/60);
        if($hours >= 1){
            $result += 15 * $hours;
        }
        else{
            echo "GPS не может быть подключен!";
        }
    }
}

class Driver implements iService{

    public function addServiceToPrice(iPrice $price, &$result)
    {
            $result += 100;
    }
}

$base = new Base( 5, 60 );
$base->additionalService(new GPS());
$base->additionalService(new Driver());
echo "Базовый тариф(5 километров, 60 минут) с водителем и GPS - ". $base->countPrice();

echo "</br>";

$student = new Student( 3, 30 );
echo "Студенческий тариф(3 километра, 30 минут) - ". $student->countPrice();

echo "</br>";

$hours = new Hours( 6, 121 );
echo "Часовой тариф (6 километров, 120 минут) - ". $hours->countPrice();