<?php

namespace Pkg6\Apidoc\Annotation;

class ApiReturnHeaders
{
    /**
     * @var mixed
     */
    protected $response;
    /**
     * @var string
     */
    protected $description;

    public function __construct(array $values)
    {
        if (isset($values['response'])) {
            $this->response = $values['response'];
        }
        if (isset($values['description'])) {
            $this->description = (string)$values['description'];
        }
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}