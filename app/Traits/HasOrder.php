<?php

namespace App\Traits;

trait HasOrder
{
    public static function getNextUrutan(string $column = 'urutan'): int
    {
        $lastOrder = static::lockForUpdate()->max($column);
        return $lastOrder ? $lastOrder + 1 : 1;
    }
}
