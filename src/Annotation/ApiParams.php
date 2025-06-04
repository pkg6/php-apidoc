<?php

namespace Pkg6\Apidoc\Annotation;

class ApiParams
{
    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var bool
     */
    protected $required = false;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var mixed
     */
    protected $sample;

    public function __construct(array $values)
    {
        if (isset($values['type'])) {
            $this->type = (string)$values['type'];
        }
        if (isset($values['name'])) {
            $this->name = (string)$values['name'];
        }
        if (isset($values['required'])) {
            $this->required = (bool)$values['required'];
        }
        if (isset($values['description'])) {
            $this->description = (string)$values['description'];
        }
        if (isset($values['sample'])) {
            $this->sample = $values['sample'];
        }
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getSample()
    {
        return $this->sample;
    }

}