<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language\Php;


use Plant2Code\Language\AbstractNamespace;

/**
 * Class PhpNamespace
 *
 * @package Plant2Code\Language\Php
 */
class PhpNamespace extends AbstractNamespace
{

    protected static $delimiter = '\\';

    /**
     * @return string
     */
    public function __toString()
    {
        $ns = $this->rootNs ? $this->rootNs . self::$delimiter . $this->name : $this->name;

        return "namespace {$ns};";
    }
}