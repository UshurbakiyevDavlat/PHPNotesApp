<?php

namespace App\Core;

class Validator
{
    /**
     * TODO refactor validator functionality
     * Validate string rule
     *
     * @param string $str
     * @param int $min
     * @param int $max
     * @return array|string
     */
    public static function string(string $str, int $min = 1, int $max = 255): array|string
    {
        $str = trim($str);
        $result = [];

        if ($str === '') {
            $result['errors'][] = 'The note body is required.';
        }

        if (!(strlen($str) >= $min
            &&
            strlen($str) <= $max)
        ) {
            if (strlen($str) < $min) {
                $result['errors'][] = 'The note body must be at least ' . $min . ' characters.';
            }
            if (strlen($str) > $max) {
                $result['errors'][] = 'The note body must be less than ' . $max . ' characters.';
            }
        }

        if (!empty($result['errors'])) {
            return implode(';', $result['errors']);
        }

        return $result;
    }

    /**
     * Validate email rule function
     *
     * @param string $email
     * @return bool
     */
    public static function email(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
