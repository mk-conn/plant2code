<?php


namespace Plant2Code\Parser\Peg;


class Connection
{

    public function __construct($leftObject, $connection, $rightObject)
    {
        $this->leftObject = $leftObject;
        $this->rightObject = $rightObject;
        $this->connection = $connection;
    }
}
