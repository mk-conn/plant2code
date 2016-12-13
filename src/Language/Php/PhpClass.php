<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language\Php;


use Plant2Code\Language\AbstractClass;

/**
 * Class PhpClass
 *
 * @package Plant2Code
 *
 * @property array $uses
 */
class PhpClass extends AbstractClass
{
    /**
     * @var array
     */
    protected static $fillable;

    /**
     * PhpClass constructor.
     *
     * @param string|null            $name
     * @param AbstractNamespace|null $namespace
     * @param array                  $properties
     * @param array                  $methods
     */
    public function __construct(string $name = null, AbstractNamespace $namespace = null, array $properties = [],
                                array $methods = [])
    {

        self::$fillable = array_merge(parent::$fillable, ['uses']);

        parent::__construct($name, $namespace, $properties, $methods);
    }

    /**
     * @param $class
     */
    public function addUse($class)
    {
        $this->attributes['uses'][] = $class;
    }

    /**
     * @param AbstractClass $class
     *
     * @return AbstractClass
     */
    public function addImplement(AbstractClass $class): AbstractClass
    {
        $ns = null;

        if ($this->namespace->name !== $class->namespace->name) {
            $ns = '\\' . $class->namespace->name . '\\';
        }

        $this->attributes['implements'][] = $ns . $class->name;

        return $this;
    }

    /**
     * @param AbstractClass $class
     *
     * @return string
     */
    public function setExtendsAttribute($class)
    {
        $ns = null;

        if (isset($this->namespace) && isset($class->namespace)) {
            if ($this->namespace->name !== $class->namespace->name) {
                $ns = '\\' . $class->namespace->name . '\\';
            }
        }

        return $ns . $class->name;
    }

}