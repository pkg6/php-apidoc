<?php

namespace Pkg6\Apidoc\View;

use Pkg6\Apidoc\Response;

class JsonView extends BaseView
{
    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $data     = json_encode($this->st_data, JSON_FORCE_OBJECT);

        $response = new Response();
        $response->setContentType('application/json');
        $response->closeConection();
        $response->send($data);
    }
}