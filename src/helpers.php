<?php

if (!function_exists('clean_string')) {
    /**
     * Remove any character that is not a letter or a number and replace it
     * with the given separator.
     *
     * @param  string  $string
     * @param  string  $separator
     *
     * @return string
     */
    function clean_string(string $string, string $separator = '-') : string
    {
        $string = strtolower($string);

        $string = preg_replace(
            '![^'.preg_quote($separator).'\pL\pN]+!u', $separator, $string
        );

        return trim($string, $separator);
    }
}
