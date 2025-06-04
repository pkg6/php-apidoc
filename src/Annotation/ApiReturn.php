<?php

namespace Pkg6\Apidoc\Annotation;

class ApiReturn
{
    const TYPES = [
        'object',
        'array',
        'array(object) ',
        'string',
        'boolean',
        'integer',
        'float',
        'number',
    ];
    /**
     * @var mixed
     */
    protected $response;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var string
     */
    protected $type;

    public function __construct(array $values)
    {
        if ($values['type']) {
            $this->type = (string)$values['type'];
        }
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