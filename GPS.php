<?php

class GPS implements iService
{
    public function addServiceToPrice(iPrice $price, &$result)
    {
        $hours = ceil($price->getMinutes() / 60);
        if ($hours >= 1) {
            $result += 15 * $hours;
        } else {
            echo "GPS не может быть подключен!";
        }
    }
}