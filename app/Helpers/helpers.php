<?php

use Illuminate\Support\Number;

if (! function_exists('format_currency')) {
    function format_currency($amount, $currencyCode = 'EGP') {
        return Number::currency($amount, in: $currencyCode, locale: app()->getLocale());
    }
}