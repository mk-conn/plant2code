<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language;


class Factory
{
    /**
     * @param $language
     *
     * @return ComponentBuilder
     */
    public static function create($language)
    {
        $class = 'Plant2Code\\Language\\' . studly_case($language);

        return new $class();
    }

}