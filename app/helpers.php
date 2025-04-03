<?php
if (! function_exists('ordinal')) {
    function ordinal($number)
    {
        $suffix = ['th', 'st', 'nd', 'rd'];
        $lastDigit = $number % 10;
        $lastTwoDigits = $number % 100;

        if ($lastTwoDigits >= 11 && $lastTwoDigits <= 13) {
            $suffixIndex = 0; // Special case for 11th, 12th, 13th
        } else {
            $suffixIndex = ($lastDigit < 4) ? $lastDigit : 0; // General case
        }

        return $number . $suffix[$suffixIndex];
    }
}
