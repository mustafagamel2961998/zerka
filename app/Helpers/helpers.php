<?php

use Illuminate\Support\Number;

if (! function_exists('format_currency')) {
    function format_currency($amount, $currencyCode = 'EGP') {
        return Number::currency($amount, in: $currencyCode, locale: app()->getLocale());
    }
}


if (! function_exists('current_currency_code')) {
    function current_currency_code() {
        $currencyCode ='EGP';
        if(auth()->check()){
            $currencyCode = auth()->user()->country->currency->code;
        }
        return $currencyCode;
    }
}