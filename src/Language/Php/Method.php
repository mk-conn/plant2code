<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language\Php;


use Plant2Code\Language\AbstractClassMethod;

/**
 * Class PhpClassMethod
 *
 * @package Plant2Code\Language\Php
 */
class Method extends AbstractClassMethod
{

    /**
     * @return string
     */
    public function __toString()
    {
        $args = [];
        $method = "/**\n";
        $method .= " *\n";
        /** @var AbstractClassMethodArgument $argument */
        foreach ($this->arguments as $argument) {
            $method .= " * @param {$argument->type} \${$argument->name}\n";
            $args[] = $argument->type . ' $' . $argument->name;
        }
        $method .= " */\n";

        $method .= sprintf('%s function %s(%s) {}', $this->visibility, $this->name, implode(', ', $args));

        return $method;
    }


}