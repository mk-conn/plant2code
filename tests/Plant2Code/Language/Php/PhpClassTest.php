<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Php\Language\Php;


use Plant2Code\Language\Php\PhpClass;
use Plant2Code\Language\Php\Method;
use Plant2Code\Language\Php\Property;
use Tests\TestCase;

/**
 * Class PhpClassTest
 * @package Plant2Php\Language\Php
 */
class PhpClassTest extends TestCase
{
    /**
     *
     */
    public function testClassProperties()
    {
        $class = new PhpClass();

        $class->name = 'Test';
        $class->abstract = true;
        $class->extends = new PhpClass('BaseTest');
        $class->addUse('Random\\ClassTest');
        $class->addUse('Other\\Randomn\\TestClass');

        $this->assertEquals('Test', $class->name);
        $this->assertEquals(true, $class->abstract);
        $this->assertEquals('BaseTest', $class->extends);

        $this->assertCount(2, $class->uses);

    }

    /**
     *
     */
    public function testPropertiesAreAdded()
    {
        $class = new PhpClass();
        $class->addProperty(new Property('string #username'));
        $class->addProperty(new Property('string #lastname'));

        $this->assertCount(2, $class->getProperties());
    }

    /**
     *
     */
    public function testMethodsAreAdded()
    {
        $class = new PhpClass();

        $class->addMethod(new Method('void #update()'));
        $class->addMethod(new Method('void #delete()'));

        $this->assertCount(2, $class->getMethods());
    }
}
