<?php

class Hours extends Price
{
    public $perKilom = 0;
    public $perMinute = 200 / 60;

    public function __construct($kiloms, $minutes)
    {
        parent::__construct($kiloms, $minutes);
        if ($this->minutes < 60) {
            $this->minutes = 60;
        } else {
            $this->minutes = (ceil($this->minutes / 60) * 60);
        }
    }
}