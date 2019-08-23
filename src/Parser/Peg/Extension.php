<?php


namespace Plant2Code\Parser\Peg;


class Extension
{
    public $isLeft = false;

    public function __construct($isLeft)
    {
        $this->isLeft = $isLeft;
    }
}
