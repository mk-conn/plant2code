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

    /**
     * Converts something like class1.class2 or
     * class1::class2 into class1\class2
     *
     * @param $name
     *
     * @return string
     */
    public function setNameAttribute($name)
    {
        return preg_replace('/[^a-zA-z0-9]+/', '\\', $name);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $ns = $this->rootNS ? $this->rootNS . '\\' . $this->name : $this->name;

        return "namespace {$ns};";
    }
}