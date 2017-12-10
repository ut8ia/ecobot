<?php

namespace common\helpers;

/**
 * Class CommonHelper
 * @package common\helpers
 */
class CommonHelper
{

    /**
     * @param $array
     * @param $multiplier
     * @return array
     */
    public static function arrayMult($array, $multiplier)
    {
        return array_map(function($n) use ($multiplier) {
            return $n === null ? null : $n * $multiplier;
        }, $array);
    }

}