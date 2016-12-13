<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language\Java;


use Plant2Code\Language\AbstractClass;

/**
 * Class JavaClass
 * @package Plant2Code\Language\Java
 */
class JavaClass extends AbstractClass
{

    public function __construct()
    {
        $this->attributes['visibility'] = 'public';
    }

}