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
 */
abstract class AbstractNamespace extends AbstractLanguage
{

    protected static $fillable = ['name'];

    /**
     * AbstractNamespace constructor.
     *
     * @param $name
     */
    public function __construct(string $name = null)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }

}