<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language;


/**
 * Class AbstractLanguage
 *
 * @package Plant2Code\Language
 */
abstract class AbstractLanguage
{

    /**
     * @var array
     */
    protected static $visibilityMap = [
        '#' => 'protected',
        '-' => 'private',
        '~' => 'package private',
        '+' => 'public'
    ];

    /**
     * @var array
     */
    protected $attributes = [];

    protected static $fillable;

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        if (in_array($key, static::$fillable)) {

            $setAttributeMethod = camel_case('set_' . $key . '_attribute');
            if (method_exists($this, $setAttributeMethod)) {
                $value = $this->$setAttributeMethod($value);
            }

            $this->attributes[ $key ] = $value;

        }
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return !is_null($this->getAttribute($key));
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[ $key ];
        }
    }

    /**
     * @param $key
     *
     * @return mixed|null
     */
    public function __get($key)
    {
        return $this->getAttribute($key);

    }

    /**
     * @return array
     */
    public function getVisibilityMap()
    {
        return static::$visibilityMap;
    }

    /**
     * @param $character
     *
     * @return mixed|null
     */
    public function getVisibilityForCharacter($character)
    {
        $map = static::$visibilityMap;

        if (isset($map[ $character ])) {
            return $map[ $character ];
        }

        return null;
    }
}