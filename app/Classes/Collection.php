<?php

namespace App\Classes;

use Illuminate\Http\Client\Response;

abstract class Collection
{
    protected APIData $data_object;

    public function __construct(APIData $data_obj)
    {
        $this->data_object = $data_obj;
    }

    public abstract function createCollection();
}