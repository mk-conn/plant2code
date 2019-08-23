<?php


namespace Plant2Code\Parser\Peg;


class Field
{
    protected $accessType;
    protected $memberName;
    protected $returnType;

    public function __construct($accessType, $returnType, $memberName)
    {
        $this->accessType = $accessType;
        $this->returnType = $returnType;
        $this->memberName = $memberName;
    }

    /**
     * @return mixed
     */
    public function getAccessType()
    {
        return $this->accessType;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->memberName;
    }

    /**
     * @return mixed
     */
    public function getReturnType()
    {
        return $this->returnType;
    }


}
