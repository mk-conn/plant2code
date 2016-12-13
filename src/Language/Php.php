<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language;


use Plant2Code\Language\Php\Argument;
use Plant2Code\Language\Php\Method;
use Plant2Code\Language\Php\PhpClass;
use Plant2Code\Language\Php\PhpNamespace;
use Plant2Code\Language\Php\Property;

/**
 * Class Php
 *
 * @package Plant2Code\Language
 */
class Php extends ComponentBuilder
{
    /**
     * @var string
     */
    protected $extension = '.php';
    /**
     * @var string
     */
    protected $nsSeparator = '\\';

    /**
     * @return PhpClass
     */
    public function createClass()
    {
        return new PhpClass();
    }

    /**
     * @param $name
     *
     * @return PhpNamespace
     */
    public function createNamespace($name)
    {
        return new PhpNamespace($name);
    }

    /**
     * @param string|null $name
     * @param string|null $type
     * @param string|null $visibility
     *
     * @return Property
     */
    public function createProperty(string $name = null, string $type = null, string $visibility = null)
    {
        return new Property($name, $type, $visibility);
    }

    /**
     * @param string|null $name
     * @param string|null $type
     *
     * @return Argument
     */
    public function createMethodArgument(string $name = null, string $type = null)
    {
        return new Argument($name, $type);
    }

    /**
     * @param string|null $name
     * @param string|null $visibility
     * @param array       $args
     * @param string|null $type
     *
     * @return Method
     */
    public function createMethod(string $name = null, string $visibility = null, array $args = [], string $type = null)
    {
        return new Method($name, $visibility, $args, $type);
    }
}