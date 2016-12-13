<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\Language;


use Plant2Code\Language\Php\PhpClass as PhpClassComponent;
use Plant2Code\Language\Java\JavaClass as JavaClassComponent;
use Tests\TestCase;

/**
 * Class FactoryTest
 * @package Plant2Code\Language
 */
class FactoryTest extends TestCase
{

    /**
     *
     */
    public function testGetPhpFactory()
    {
        $php = Factory::create('php');

        $phpClass = $php->createClass();

        $this->assertInstanceOf(PhpClassComponent::class, $phpClass);

    }

    /**
     *
     */
    public function testGetJavaFactory()
    {

        $java = Factory::create('java');
        $javaClass = $java->createClass();

        $this->assertInstanceOf(JavaClassComponent::class, $javaClass);
    }


}
