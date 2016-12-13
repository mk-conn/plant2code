<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language\Php;


class PhpClassPropertyTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testPropertyOutput()
    {
        $property = new Property('username', 'string', 'protected');

        $expected = "/**\n";
        $expected .= " * @var string\n";
        $expected .= " */\n";
        $expected .= "protected \$username;";

        $this->assertEquals($expected, (string)$property);
    }
}
