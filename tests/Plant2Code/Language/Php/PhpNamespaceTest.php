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
 * Class PhpNamespaceTest
 * @package Plant2Code\Language\Php
 */
class PhpNamespaceTest extends TestCase
{

    /**
     *
     */
    public function testNamespaceOutput()
    {
        $ns = new PhpNamespace('User.Land');

        $this->assertEquals('namespace User\\Land;', (string) $ns);
    }
}
