<?php

abstract class Price implements iPrice
{
    public $kiloms;
    public $minutes;
    public $perKilom;
    public $perMinute;
    private $services;
    public $result;

    public function __construct($kiloms, $minutes)
    {
        $this->kiloms = $kiloms;
        $this->minutes = $minutes;
    }

    public function countPrice()
    {
        $result = $this->kiloms * $this->perKilom + $this->minutes * $this->perMinute;

        if ($this->services) {
            foreach ($this->services as $value) {
                $value->addServiceToPrice($this, $result);
            }
        }

        return $result;
    }

    public function additionalService(iService $service)
    {
        $this->services[] = $service;
    }

    public function getMinutes()
    {
        return $this->minutes;
    }

    public function getKiloms()
    {
        return $this->kiloms;
    }
}