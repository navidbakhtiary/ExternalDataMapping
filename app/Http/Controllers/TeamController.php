<?php

namespace App\Http\Controllers;

use App\Classes\TeamJsonResponse;
use App\Classes\TeamXMLResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TeamController extends Controller
{
    public function jsonIndex()
    {
        $response = Http::get(config('global.ext_api.teams.url'));

        // dd($response->body(), $response->object(), $response->json());
        $json_response = new TeamJsonResponse($response);
        $json_response->extractData();
        dd($json_response->data);
        // {
        //     dd($json_response->data);
        // }
        return '';
    }

    public function xmlIndex()
    {
        $response = Http::get(config('global.ext_api.teams.url') . '.xml');
        // $bodbod = simplexml_load_string($response->body());
        // dd($bodbod, property_exists($bodbod, 'data'));
        $xml_response = new TeamXMLResponse($response);
        $xml_response->extractData();
        dd($xml_response->data); 
        // {
        //     dd($xml_response->data);
        // }
        return 'error xml';
    }
}
