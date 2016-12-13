<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language;


/**
 * Class AbstractClassMethod
 *
 * @package Plant2Code\Language
 *
 * @property string $visibility
 * @property string $name
 * @property string $type
 * @property array  $arguments
 *
 */
abstract class AbstractClassMethod extends AbstractLanguage
{

    protected static $fillable = [
        'type',
        'visibility',
        'name',
        'arguments'
    ];

    /**
     * PhpClassMethod constructor.
     *
     * @param string|null $name
     * @param string|null $visibility
     * @param array       $args
     * @param string|null $type
     */
    public function __construct(string $name, string $visibility = null, array $args = [], string $type = null)
    {
        $this->name = $name;
        $this->visibility = $visibility;
        $this->arguments = $args;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->visibility . ' ' . $this->name;
    }
}