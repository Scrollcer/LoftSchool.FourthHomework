<?php

class Driver implements iService
{

    public function addServiceToPrice(iPrice $price, &$result)
    {
        $result += 100;
    }
}