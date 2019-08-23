<?php


namespace Tests\Plant2Code;


use Plant2Code\Parser\Peg\Parser;
use Plant2Code\Parser\Peg\SyntaxError;
use Tests\TestCase;

class PegParserTest extends TestCase
{
    public function testParser()
    {

        try {
            $plantUmlParser = new Parser();
            $output = $plantUmlParser->parse(file_get_contents(test_path() . '/fixtures/test-class.puml'));
            $break = true;

        } catch (SyntaxError $ex) {
            $message = "Syntax error: " . $ex->getMessage() . ' at line ' . $ex->grammarLine . ' column ' . $ex->grammarColumn . ' offset ' . $ex->grammarOffset;
            throw new \Exception($message);
        }
    }


}
