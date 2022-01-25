<?php

namespace App\Traits;

trait StringTrait
{
    /**
     * Clearing a line of garbage
     *
     * @param [type] $string
     * @return string
     */
    protected function clearString($string): string
    {
        // remove spaces from the beginning and end of a string
        $string = trim($string);

        // remove escaped characters
        $string = stripslashes($string);

        // remove tags
        $string = strip_tags($string);

        // conversion of special characters in HTML
        $string = htmlspecialchars($string);
        
        return $string;
    }
}