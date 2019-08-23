<?php


namespace Plant2Code\Parser;


class UmlClass
{


    protected function getClassName($string)
    {
        $pattern = '~class\s+([\w|:]+)\s+.*\{~';
        $matches = [];
        preg_match($pattern, $string, $matches);

    }
}