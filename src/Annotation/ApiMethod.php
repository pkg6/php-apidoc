<?php

namespace Pkg6\Apidoc\Annotation;

class ApiMethod
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const PATCH = 'PATCH';
    const DELETE = 'DELETE';
    const OPTIONS = 'OPTIONS';
    const HEAD = 'HEAD';
    protected $type = [self::GET, self::POST];

    public function __construct(array  $values)
    {
        if (isset($values['type'])) {
            $this->type = $values['type'];
        }
    }
}