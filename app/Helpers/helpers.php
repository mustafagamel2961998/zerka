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
if (! function_exists('getCurrencySymbol')) {

    function getCurrencySymbol(string $currencyCode): string
    {
        $locale = app()->getLocale();

        $formatter = new \NumberFormatter("{$locale}@currency={$currencyCode}", \NumberFormatter::CURRENCY);

        $symbol = $formatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);

        return $symbol ?: $currencyCode; // fallback لو الرمز مش موجود
    }
}