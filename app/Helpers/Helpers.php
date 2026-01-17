<?php

if (!function_exists('idr_short')) {
    function idr_short($value)
    {
        if (!$value) return '-';

        if ($value >= 1000000) {
            return 'IDR ' . number_format($value / 1000000, 1) . 'M';
        }

        return 'IDR ' . number_format($value / 1000, 0) . 'K';
    }
}