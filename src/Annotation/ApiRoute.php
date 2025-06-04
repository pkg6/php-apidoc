<?php

namespace Pkg6\Apidoc\Annotation;

class ApiRoute
{
    /**
     * @var string
     */
    protected $name;

    public function __construct(array $values)
    {
        if (isset($values['name'])) {
            $this->name = (string)$values['name'];
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}