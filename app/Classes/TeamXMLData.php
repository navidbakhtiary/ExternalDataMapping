<?php

namespace App\Classes;

class TeamXMLData extends XMLData implements DataInterface
{
    private $xml_data;

    public function extractData()
    {
        $this->data = null;
        $this->xml_data = simplexml_load_string($this->response->body());
        if ($this->hasContent() && $this->hasData()) {
            $xml = $this->xml_data->{config('global.ext_api.teams.data_key')};
            $this->data = json_decode(json_encode($xml))->item;
        }
    }

    public function hasData()
    {
        return property_exists($this->xml_data, config('global.ext_api.teams.data_key'));
    }
}
