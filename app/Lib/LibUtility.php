<?php

namespace App\Lib;

/**
 * [Library] Common Utility Class
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since April 12, 2025
 */
class LibUtility
{

    /**
     * [General] Check if value is <string>
     * @param mixed $mParam (passed argument)
     * @return bool
     */
    public static function isString($mParam)
    {
        return mb_strlen(trim($mParam)) > 0;
    }

    /**
     * [General] Check if value is <array>
     * @param mixed $mParam (passed argument)
     * @return bool
     */
    public static function isArray($mParam)
    {
        return is_array($mParam) > 0 && count($mParam) > 0;
    }

    /**
     * [General] Check if value is <empty>
     * @param mixed $mParam (passed argument)
     * @return bool
     */
    public static function isEmpty($mParam)
    {
        return is_null($mParam);
    }

    /**
     * [General] Check if value is <int>
     * @param mixed $mParam (passed argument)
     * @return bool
     */
    public static function isInteger($mParam)
    {
        return is_int($mParam);
    }

    /**
     * [General] Check if value is <float in string or int>
     * @param mixed $mParam (passed argument)
     * @return bool
     */
    public static function isNumeric($mParam)
    {
        return is_numeric($mParam);
    }

    /**
     * [General] Check if value is <date>
     * @param mixed $mParam (date value)
     * @param string $sFormat (ex. YY-mm-dd)
     * @return mixed
     * @throws \Exception
     */
    public static function isDate($mParam, string $sFormat)
    {
        $oDateTime = \DateTime::createFromFormat($sFormat, $mParam);
        return $oDateTime && $oDateTime->format($sFormat) === $mParam;
    }

    /**
     * [General] Check if value is <json>
     * @param mixed $mParam (json value) $sFormat (ex. {"code":"test"})
     * @return bool
     */
    public static function isJSON($mParam)
    {
        return LibUtility::isArray(json_decode($mParam, true));
    }

    /**
     * [General] Check if user access in mobile
     * @param string $sHttpUserAgent (request()->userAgent())
     * @return false|int
     */
    public static function checkIfUserAccessInMobile(string $sHttpUserAgent = "")
    {
        $sMobilePregMatch = "/(android|webos|avantgo|iphone|ipad|ipod|blackberry|iemobile|bolt|boost|cricket|docomo|fone|hiptop|mini|opera mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|wos)/i";
        return preg_match($sMobilePregMatch, $sHttpUserAgent);
    }

    /**
     * [General] Get file name extension
     * @param string $sFileName (ex. sample.pdf)
     * @return string
     */
    public static function getFileExtension($sFileName)
    {
        return pathinfo($sFileName, PATHINFO_EXTENSION);
    }

    /**
     * [General] Check if the file is an image
     * @param string $fileName (ex. sample.png)
     * @return bool
     */
    public static function isImage($fileName)
    {
        $imageExtensions = ['png', 'jpg', 'jpeg', 'gif', 'bmp', 'webp', 'tiff', 'tif', 'svg', 'ico', 'heic'];
        $fileExtension = strtolower(self::getFileExtension($fileName));

        return in_array($fileExtension, $imageExtensions);
    }
}
