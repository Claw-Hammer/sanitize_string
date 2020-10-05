<?php
final class SanitizeString
{
    /** 
     * @param string $newString
     * @param bool $special
     * @return string
     */
    private static function sanitize($newString, $special) {

        $replace_array = array(
            'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
            'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'Þ' => 'B',
            'ß' => 'Ss', 'à' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i',
            'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u',
            'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y'
        );

        $sanitized = strtr($newString, $replace_array);

        if ($special === false) {
            return $sanitized;
        }

        $specialChars_array = array(
            '%' => '', '*' => '', '#' => '', '&' => '', '$' => '', '(' => '', ')' => '', '^' => '', '@' => '', '{' => '',
            '}' => '', '!' => '',  '?' => '', '~' => '', '<' => '', '>' => '', '/' => '', '[' => '', ']' => '', '|' => ''
        );
                                
        return strtr($sanitized, $specialChars_array);
    }


    /**
     * Replace foreign and special characters on a filename or string
     * @param string $string
     * @param bool $isFileName
     * @param bool $special
     * @return string
     */
    public static function clean($string, $isFileName = false, $special = false) {

        if ($isFileName) {

            if (rename($string, self::sanitize($string, $special)) === false) {
                throw new Exception("The renaming process of file ( ${string} ) failed");
            }

        } else {

            return self::sanitize($string, $special);
        }
    }
}
