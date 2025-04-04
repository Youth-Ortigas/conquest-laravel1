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

if (! function_exists('asset_versioned')) {
    function asset_versioned($path, $type, $raw_code = '') {
        switch($type) {
            case 'css':
                return '<link href="' . asset($path) . '?v=' . (file_exists(public_path($path)) ? filemtime(public_path($path)) : time()) . '" rel="stylesheet" ' . $raw_code . ' >';
            case 'js':
                return '<script src="' . asset($path) . '?v=' . (file_exists(public_path($path)) ? filemtime(public_path($path)) : time()) . '" ' . $raw_code . '></script>';
            case 'img':
                $imagePath = public_path($path);
                $defaultPath = public_path('img/daily_time_record/default_pic.png');

                $src = file_exists($imagePath) ? asset($path) : asset('img/daily_time_record/default_pic.png');
                $timestamp = file_exists($imagePath) ? filemtime($imagePath) : filemtime($defaultPath);

                return '<img src="' . $src . '?v=' . $timestamp . '" ' . $raw_code . '>';
        }
    }
}
