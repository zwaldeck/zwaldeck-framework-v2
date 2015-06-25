<?php

namespace Zwaldeck\Core\Utils;

/**
 * Class StringUtils
 * @package Zwaldeck\Core\Utils
 */
class StringUtils {

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
    }

    public static function contains($haystack, $needle) {
        return strpos($haystack, $needle) !== FALSE;
    }

    public static function getContentBetweenTags($haystack, $opening, $closing) {
        $pattern = "~{$opening}(.*?){$closing}~";
        preg_match_all($pattern, $haystack, $matches);
        return $matches[1];
    }
}