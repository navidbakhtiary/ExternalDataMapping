<?php

namespace App\Classes;


class TeamJsonResponse extends JsonResponse implements ResponseData
{
    public function extractData()
    {
        $this->data = null;
        if ($this->hasContent() && $this->hasData())
        {   
            $this->data = $this->content->{config('global.ext_api.teams.data_key')};
        }
    }

    public function hasData()
    {
        return property_exists($this->content, config('global.ext_api.teams.data_key'));
    }
}