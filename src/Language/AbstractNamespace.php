<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language;


/**
 * Class AbstractNamespace
 *
 * @package Plant2Code\Language
 *
 * @property string $name
 * @property string $rootNs
 */
abstract class AbstractNamespace extends AbstractLanguage
{
    /**
     * @var array
     */
    protected static $fillable = ['name', 'rootNs'];
    /**
     * @var null
     */
    protected static $delimiter = null;

    /**
     * AbstractNamespace constructor.
     *
     * @param string|null $name
     * @param string|null $rootNs
     */
    public function __construct(string $name = null, string $rootNs = null)
    {
        $this->name = $name;
        $this->rootNs = $rootNs;
    }

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
        return $this->adjustNamespace($name);
    }

    /**
     * @param $rootNs
     *
     * @return mixed
     */
    public function setRootNsAttribute($rootNs)
    {
        return $this->adjustNamespace($rootNs);
    }

    /**
     * @return string
     */
    public function getDelimiter()
    {
        return static::$delimiter;
    }

    /**
     * Converts something like class1.class2 or
     * class1::class2 into class1\class2
     *
     * @param $ns
     *
     * @return string
     */
    protected function adjustNamespace($ns)
    {
        return preg_replace('/[^a-zA-z0-9]+/', static::$delimiter, $ns);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }

}