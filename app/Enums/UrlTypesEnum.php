<?php

namespace App\Enums;

class UrlTypesEnum
{


    public const PAGES = 'pages';
    public const CATEGORY = 'category';
    public const PRODUCTS = 'products';
    public const AllPRODUCTS = 'all products';


    public static function values(): array
    {

        return [
            static::PAGES => 'pages',
            static::CATEGORY => 'category',
            static::PRODUCTS => 'products',
            static::AllPRODUCTS => 'all products',
        ];
    }

}