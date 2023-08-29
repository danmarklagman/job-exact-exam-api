<?php

/**
 * String specific helpers.
 */

if (!function_exists('period_at_the_end')) {
    function period_at_the_end($string): string
    {
        return substr($string, -1) !== '.' ? $string . '.' : $string;
    }
}
