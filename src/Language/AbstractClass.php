<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language;


/**
 * Class AbstractClass
 *
 * @package Plant2Php\Language
 *
 * @property string            $name
 * @property AbstractNamespace $namespace
 * @property array             $properties
 * @property array             $methods
 * @property string            $visibility
 * @property string            $extends
 * @property string            $implements
 * @property bool              $final
 * @property bool              $abstract
 * @property bool              $interface
 *
 */
abstract class AbstractClass extends AbstractLanguage
{

    /**
     * @var array
     */
    protected static $fillable = [
        'name',
        'namespace',
        'properties',
        'methods',
        'visibility',
        'extends',
        'implements',
        'abstract',
        'interface',
        'final'
    ];

    /**
     * AbstractClass constructor.
     *
     * @param string|null            $name
     * @param AbstractNamespace|null $namespace
     * @param array                  $properties
     * @param array                  $methods
     */
    public function __construct(string $name = null, AbstractNamespace $namespace = null, array $properties = [],
                                array $methods = [])
    {
        $this->name = $name;
        $this->namespace = $namespace;
        $this->methods = $methods;
        $this->properties = $properties;
    }

    /**
     * @param $property
     *
     * @return AbstractClass
     */
    public function addProperty($property): AbstractClass
    {
        $this->attributes['properties'][] = $property;

        return $this;
    }

    /**
     * @param $method
     *
     * @return AbstractClass
     */
    public function addMethod($method): AbstractClass
    {
        $this->attributes['methods'][] = $method;

        return $this;
    }


    /**
     * @param AbstractClass $class
     *
     * @return AbstractClass
     */
    public function addImplement(AbstractClass $class): AbstractClass
    {
        $this->attributes['implements'][] = $class;

        return $this;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        if (isset($this->attributes['properties'])) {

            return $this->attributes['properties'];
        }

        return null;
    }

    /**
     * @return array
     */
    public function getMethods()
    {
        if (isset($this->attributes['methods'])) {

            return $this->attributes['methods'];
        }

        return null;
    }

    /**
     * @return array
     */
    public function getImplements()
    {
        if (isset($this->attributes['implements'])) {
            return $this->attributes['implements'];
        }

        return null;
    }

}