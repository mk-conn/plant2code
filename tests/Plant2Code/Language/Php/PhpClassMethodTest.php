<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language\Php;


use Tests\TestCase;

/**
 * Class PhpClassMethodTest
 *
 * @package Plant2Code\Language\Php
 */
class PhpClassMethodTest extends TestCase
{

    /**
     *
     */
    public function testMethodOutput()
    {
        $method = new Method('update', 'protected');
        $method->visibility = 'protected';

        $expected = "/**\n";
        $expected .= " *\n";
        $expected .= " */\n";
        $expected .= "protected function update() {}";

        $this->assertEquals($expected, (string)$method);
    }

    /**
     *
     */
    public function testMethodOutPuthWithArguments()
    {
        $arg1 = new Argument('count', 'int');
        $arg2 = new Argument('force', 'bool');
        $method = new Method('update', 'public', [$arg1, $arg2]);

        $expected = "/**\n";
        $expected .= " *\n";
        $expected .= " * @param int \$count\n";
        $expected .= " * @param bool \$force\n";
        $expected .= " */\n";
        $expected .= "public function update(int \$count, bool \$force) {}";

        $this->assertEquals($expected, (string)$method);
    }

    /**
     *
     */
    public function testMethodOutPuthWithArgumentsWithoutType()
    {
        $arg1 = new Argument('count');
        $arg2 = new Argument('force');
        $method = new Method('update', 'public', [$arg1, $arg2]);

        $expected = "/**\n";
        $expected .= " *\n";
        $expected .= " * @param  \$count\n";
        $expected .= " * @param  \$force\n";
        $expected .= " */\n";
        $expected .= "public function update( \$count,  \$force) {}";

        $this->assertEquals($expected, (string)$method);
    }
}
