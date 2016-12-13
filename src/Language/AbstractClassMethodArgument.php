<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language;


/**
 * Class AbstractClassMethodArgument
 *
 * @package Plant2Code\Language
 *
 * @property string $type
 * @property string $name
 *
 */
class AbstractClassMethodArgument extends AbstractLanguage
{
    /**
     * @var array
     */
    protected static $fillable = ['type', 'name'];

    /**
     * AbstractClassMethodArgument constructor.
     *
     * @param string|null $name
     * @param string|null $type
     */
    public function __construct(string $name = null, string $type = null)
    {
        $this->name = $name;
        $this->type = $type;
    }

}