<?php
namespace mz\InventarioBundle\Utils;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder as PasswordEncoder;

class Utils
{
    static public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }

    static function encodePassword($pass, $salt=null){
        $encoder = new PasswordEncoder('sha512', true, 13);
        $result = $encoder->encodePassword($pass, $salt);
        return $result;
    }
}