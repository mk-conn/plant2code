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
 * @property string $rootNS
 */
abstract class AbstractNamespace extends AbstractLanguage
{
    /**
     * @var array
     */
    protected static $fillable = ['name', 'rootNS'];

    /**
     * AbstractNamespace constructor.
     *
     * @param string|null $name
     * @param string|null $rootNS
     */
    public function __construct(string $name = null, string $rootNS = null)
    {
        $this->name = $name;
        $this->rootNS = $rootNS;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }

}