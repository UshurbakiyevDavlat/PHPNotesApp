<?php

class Validator
{
    public static function string($str, $min = 1, $max = 255): bool
    {
        $str = trim($str);
        return (strlen($str) >= $min && strlen($str) <= $max);
    }

    public function email($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
