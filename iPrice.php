<?php

interface iPrice
{
    public function countPrice();

    public function additionalService(iService $service);

    public function getMinutes();

    public function getKiloms();
}

