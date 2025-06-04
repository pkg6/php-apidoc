<?php

namespace Pkg6\Apidoc\Annotation;

class ApiDescription
{
    protected $section;
    protected $description;

    public function __construct(array $values)
    {
        if ($values['section']) {
            $this->section = $values['section'];
        }
        if ($values['description']) {
            $this->description = $values['description'];
        }
    }

    public function getSection()
    {
        return $this->section;
    }

    public function getDescription()
    {
        return $this->description;
    }
}