<?php

class Validator
{
    public static function string($str, $min = 1, $max = 255): array
    {
        $str = trim($str);
        $result = [
            'errors' => ''
        ];

        if ($str === '') {
            $result['errors'] .= 'The note body is required.';
        }

        if (!(strlen($str) >= $min && strlen($str) <= $max)) {
            if (strlen($str) < $min) {
                $result['errors'] .= 'The note body must be at least ' . $min . ' characters.';
            }
            if (strlen($str) > $max) {
                $result['errors'] .= 'The note body must be less than ' . $max . ' characters.';
            }
        }

        return $result;
    }

    public function email($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
