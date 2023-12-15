<?php
namespace App\Helpers;

class Random
{
    public static function generate($longitud)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($characters), 0, $longitud);
    }
}