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
 * @package Plant2Code\Language
 *
 * @property string $name
 */
abstract class AbstractNamespace extends AbstractLanguage
{

    protected static $fillable = ['name'];

    /**
     * AbstractNamespace constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;

        $this->correct();
    }

    abstract protected function correct();

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }

}