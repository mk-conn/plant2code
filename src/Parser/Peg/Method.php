<?php


namespace Plant2Code\Parser\Peg;


class Method
{
    protected $accessType;
    protected $returnType;
    protected $fieldName;
    protected $parameters;

    public function __construct($accessType, $returnType, $fieldName, $parameters)
    {
        $this->accessType = $accessType;
        $this->fieldName = $fieldName;
        $this->returnType = $returnType;
        $this->parameters = $parameters;
    }


}
