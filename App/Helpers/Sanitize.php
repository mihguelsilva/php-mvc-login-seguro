<?php
namespace App\Helpers;

class Sanitize
{
    public static function string(string $data): string
    {
        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }

    public static function email(string $email): string
    {
        return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    }

    public static function int(string $number): int
    {
        return filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function url(string $url): string
    {
        return filter_var(trim($url), FILTER_SANITIZE_URL);
    }
}
?>