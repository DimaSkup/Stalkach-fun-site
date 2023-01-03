<?php


namespace App\Helpers\Traits;


trait FormatUtils
{
    public static function transList(array $const): array
    {
        return array_map(static fn($item) => trans($item), $const);
    }
}
