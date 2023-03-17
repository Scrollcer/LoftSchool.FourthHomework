<?php

interface iService
{
    public function addServiceToPrice(iPrice $price, &$result);
}