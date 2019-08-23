<?php


namespace Plant2Code\Parser\Peg;


class Connection
{
    protected $leftObject;
    protected $rightObject;
    protected $connection;

    public function __construct($leftObject, $connection, $rightObject)
    {
        $this->leftObject = $leftObject;
        $this->rightObject = $rightObject;
        $this->connection = $connection;
    }

    /**
     * @return mixed
     */
    public function getLeftObject()
    {
        return $this->leftObject;
    }

    /**
     * @return mixed
     */
    public function getRightObject()
    {
        return $this->rightObject;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }


}
