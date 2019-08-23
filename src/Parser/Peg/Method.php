<?php


namespace Plant2Code\Parser\Peg;


class Method extends Field
{
    protected $accessType;
    protected $returnType;
    protected $fieldName;
    protected $parameters;

    public function __construct($accessType, $returnType, $fieldName, $parameters)
    {
        parent::__construct($accessType, $returnType, $fieldName);

        $this->parameters = $parameters;
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
    public function getReturnType()
    {
        return $this->returnType;
    }

    /**
     * @return mixed
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }




}
