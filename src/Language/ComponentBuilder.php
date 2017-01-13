<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language;


/**
 * Class ComponentBuilder
 *
 * @package Plant2Code\Language
 */
abstract class ComponentBuilder
{
    /**
     * @var string
     */
    protected $extension;
    /**
     * @var string
     */
    protected $nsSeparator;

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getNsSeparator(): string
    {
        return $this->nsSeparator;
    }

    /**
     * @return AbstractClass
     */
    abstract public function createClass();

    /**
     * @param string|null $name
     * @param string|null $type
     * @param string|null $visibility
     *
     * @return AbstractClassProperty
     */
    abstract public function createProperty(string $name = null, string $type = null, string $visibility = null);

    /**
     * @param string      $name
     * @param string|null $visibility
     * @param array       $args
     * @param string|null $type
     *
     * @return AbstractClassMethod
     */
    abstract public function createMethod(string $name, string $visibility = null, array $args = [], string $type = null);

    /**
     * @param string|null $name
     * @param string|null $type
     *
     * @return AbstractClassMethodArgument
     */
    abstract public function createMethodArgument(string $name = null, string $type = null);

    /**
     * @param string $pumlNamespace
     * @param string $rootNS
     *
     * @return AbstractNamespace
     */
    abstract public function createNamespace(string $pumlNamespace, string $rootNS);
}