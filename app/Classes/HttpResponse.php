<?php

namespace App\Classes;

use Illuminate\Http\Client\Response;

class HttpResponse
{
    protected $response;
    protected $content;
    public $data;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->content = $response->object();
    }

    protected function hasContent()
    {
        return ($this->response->ok() && ($this->response->body() <> ''));
    }
}