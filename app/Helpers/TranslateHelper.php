<?php

use Stichoza\GoogleTranslate\TranslateClient;

// if (!function_exists('tr')) {
//     function tr(string $text): string
//     {
//         $locale = app()->getLocale();

//         // Bahasa default (Indonesia) → return langsung
//         if ($locale === 'id') {
//             return $text;
//         }

//         // Cache per bahasa
//         $cacheKey = 'tr_' . $locale . '_' . md5($text);

//         return cache()->remember(
//             $cacheKey,
//             now()->addDay(), // 1 hari
//             function () use ($text, $locale) {
//                 // PRODUKSI (aktifkan nanti)
//                 return (new TranslateClient($locale))->translate($text);

//                 // DEBUG
//                 // return '[EN] ' . $text;
//             }
//         );
//     }
// }

if (!function_exists('tr')) {
    function tr(string $text): string
    {
        $locale = app()->getLocale();

        // Bahasa default Indonesia
        if ($locale === 'id') {
            return $text;
        }

        return cache()->remember(
            "tr_{$locale}_" . md5($text),
            86400,
            function () use ($text, $locale) {
                // source = id, target = en
                $tr = new TranslateClient('id', $locale);
                return $tr->translate($text);
            }
        );
    }
}

if (!function_exists('section_id')) {
    function section_id($key)
    {
        return __('sections.' . $key);
    }
}
