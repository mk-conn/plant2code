<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language;


use Plant2Code\Language\Java\JavaClass;

class Java extends ComponentBuilder
{
    protected $extension = '.java';

    protected $nsSeparator = '.';

    public function createClass()
    {
        return new JavaClass();
    }

    public function createProperty(string $name = null, string $type = null, string $visibility = null)
    {
        // TODO: Implement createProperty() method.
    }

    public function createMethod(string $name, string $visibility = null, array $args = [], string $type = null)
    {
        // TODO: Implement createMethod() method.
    }

    public function createMethodArgument(string $name = null, string $type = null)
    {
        // TODO: Implement createMethodArgument() method.
    }

    public function createNamespace($pumlNamespace)
    {
        // TODO: Implement createNamespace() method.
    }


}