<?php

namespace App\Helpers;

class PostcodeSanitizer
{
    /**
     * Postcode validation expression
     *
     * @var string
     * @access private
     * @static
     */
    private static $validPostcode = "/^([A-Z]{1,2}\d[A-Z\d]? ?\d[A-Z]{2}|GIR ?0A{2})$/";
    /**
     * Checks if a postcode is valid
     *
     * @param string $postcode The postcode to check
     * @return bool True if valid, false if invalid
     * @access public
     * @static
     */
    public static function check($postcode)
    {
        $postcode = self::sanitize($postcode);
        if (preg_match(self::$validPostcode, $postcode)) {
            return true;
        }
        return false;
    }
    /**
     * Cleans the input and normalizes. Removes non-alphanumeric characters and
     * uppercases the result
     *
     * @param string $postcode Postcode to sanitize
     * @return string
     */
    public static function sanitize($postcode)
    {
        return preg_replace("/[^A-Za-z0-9]/", '', strtoupper($postcode));
    }
}
