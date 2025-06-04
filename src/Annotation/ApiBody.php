<?php

namespace Pkg6\Apidoc\Annotation;

class ApiBody
{
    /**
     * @var mixed
     */
    protected $body;

    public function __construct(array $values)
    {
        if (isset($values['body'])) {
            $this->body = $values['body'];
        }
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }
}