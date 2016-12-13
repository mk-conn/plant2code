<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language;


/**
 * Class AbstractClassProperty
 *
 * @package Plant2Code\Language
 *
 * @property string $name
 * @property string $type
 * @property string $visibility
 *
 */
abstract class AbstractClassProperty extends AbstractLanguage
{

    /**
     * @var array
     */
    protected static $fillable = ['type', 'name', 'visibility'];

    /**
     * AbstractClassProperty constructor.
     *
     * @param string|null $name
     * @param string|null $type
     * @param string|null $visibility
     */
    public function __construct(string $name = null, string $type = null, string $visibility = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->visibility = $visibility;
    }
}