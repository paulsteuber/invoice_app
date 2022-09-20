<?php
namespace App\Helpers;

class ChiaFormat{
    public function __construct(){

    }
    static public function toPrice($price) {
        $price = (float) $price;
        return number_format($price, 2, ',', '.');
    }
}