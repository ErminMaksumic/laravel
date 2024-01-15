<?php

namespace App\Services\Interfaces;

interface RentalCarServiceInterface extends BaseServiceInterface
{
    public function getAllPrices();
    public function getAllSearch();

}
