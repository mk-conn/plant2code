<?php


namespace Plant2Code\Parser\Peg;


class Field
{
    protected $accessorType;
    protected $memberName;
    protected $returnType;

    public function __construct($accessorType, $returnType, $memberName)
    {
        $this->accessorType = $accessorType;
        $this->returnType = $returnType;
        $this->memberName = $memberName;
    }

    /**
     * @return mixed
     */
    public function getAccessorType()
    {
        return $this->accessorType;
    }

    /**
     * @return mixed
     */
    public function getMemberName()
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
