<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code;


use Plant2Code\Language\AbstractClass;
use Tests\TestCase;

/**
 * Class ParserTest
 *
 * @package Plant2Code
 */
class ParserTest extends TestCase
{
    /**
     * Input xmi
     *
     * @var string
     */
    protected $source;

    public function testOutputFolderWithRootNamespace()
    {
        $parser = new Parser($this->source, 'php', 'UnitTest\\ParserTest');
        $classes = $parser->parse();
        /** @var AbstractClass $class */
        $folder = $classes->first()['meta']['folder'];
        $class = $classes->first()['class'];

        $this->assertEquals('UnitTest/ParserTest/' . $class->namespace->name, $folder, 'Folder output with root namespace failed.');
    }

    public function testParserDetectsAllComponents()
    {
        $parser = new Parser($this->source, 'php');

        $classes = $parser->parse();
        /** @var AbstractClass $class */
        $class = $classes->first()['class'];

        $this->assertCount(1, $classes);
        $this->assertCount(2, $class->properties);
        $this->assertCount(2, $class->methods);
        $this->assertCount(1, $class->methods[0]->arguments);
        $this->assertCount(2, $class->methods[1]->arguments);

        $this->assertEquals('scale', $class->properties[0]->name);
        $this->assertEquals('string', $class->properties[0]->type);
        $this->assertEquals('public', $class->properties[0]->visibility);

        $this->assertEquals('threshold', $class->properties[1]->name);
        $this->assertEquals('int', $class->properties[1]->type);
        $this->assertEquals('protected', $class->properties[1]->visibility);

        $this->assertEquals('size', $class->methods[0]->name);
        $this->assertEquals('longsize', $class->methods[1]->name);

        $this->assertEquals('int', $class->methods[1]->type);
        $this->assertEquals('protected', $class->methods[1]->visibility);

        $this->assertEquals('verylonglist', $class->methods[1]->arguments[0]->name);
        $this->assertEquals('array', $class->methods[1]->arguments[0]->type);
        $this->assertEquals('second', $class->methods[1]->arguments[1]->name);
        $this->assertEquals('float', $class->methods[1]->arguments[1]->type);

    }

    public function testParsingWithRootNamespace()
    {
        $parser = new Parser($this->source, 'php', 'Unittest');
        $classes = $parser->parse();
        /** @var AbstractClass $class */
        $class = $classes->first()['class'];

        $this->assertEquals('namespace Unittest\\test;', (string)$class->namespace, 'Parsing with root namespace failed.');
    }

    protected function setUp()
    {
        parent::setUp();

        $this->source = file_get_contents(test_path() . '/fixtures/parsetest.xmi');
    }


}
