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
 * @package Plant2Code\Language\Php
 */
class PhpNamespace extends AbstractNamespace
{

    /**
     * Converts something like Class1.Class2 or Class1::Class2 into Class1\Class2
     */
    protected function correct()
    {
        $this->name = preg_replace('/[^a-zA-z0-9]+/', '\\', $this->name);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "namespace {$this->name};";
    }
}