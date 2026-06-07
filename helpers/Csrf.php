<?php

class Csrf
{
    public static function token()
    {
        if (!isset($_SESSION['csrf_token']))
        {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public static function check($token)
    {
        return isset($_SESSION['csrf_token'])
            && hash_equals($_SESSION['csrf_token'], $token);
    }
}