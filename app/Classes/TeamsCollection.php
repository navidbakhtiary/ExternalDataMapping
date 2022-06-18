<?php

namespace App\Classes;

use App\Models\Team;

class TeamsCollection extends Collection
{
    protected array $teams;

    public function createCollection()
    {
        $data_obj = $this->data_object;
        $this->teams = array_map(function($item) use ($data_obj){
            return $data_obj->mapObjectToModel($item);
        }, $data_obj->data);
    }
}