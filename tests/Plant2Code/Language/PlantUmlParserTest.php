<?php


namespace Tests\Plant2Code\Language;


use Plant2Code\Parser\Peg\Parser;
use Tests\TestCase;

class PlantUmlParserTest extends TestCase
{
    public function testParser()
    {

        $plantUmlParser = new Parser();
        $output = $plantUmlParser->parse(file_get_contents(test_path() . '/fixtures/test-class.puml'));
        $break = true;
    }


}
