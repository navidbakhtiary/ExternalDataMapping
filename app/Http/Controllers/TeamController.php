<?php

namespace App\Http\Controllers;

use App\Classes\TeamJsonData;
use App\Classes\TeamsJsonCollection;
use App\Classes\TeamsXMLCollection;
use App\Classes\TeamXMLData;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Yaml;

class TeamController extends Controller
{
    public function jsonIndex()
    {
        try
        {
            //Get response from external API and extract json from it
            $response = Http::get(config('global.ext_api.teams.url'));
            $json_response = new TeamJsonData($response);
            $json_response->extractData();
            
            //Parse YAML file and get json mapper from it
            $mapper = Yaml::parseFile(config_path('mappers/team.yaml'))['json'];
            
            //Get teams data and save into database
            $collection = new TeamsJsonCollection($json_response, $mapper);
            $collection->create();
            DB::beginTransaction();
            foreach($collection->teams as $team)
            {
                $team->save();
            }
            DB::commit();
            return 'successful';
        }
        catch(Exception $exc)
        {
            DB::rollBack();
            return 'failed';
        }
    }

    public function xmlIndex()
    {
        try
        {
            //Get response from external API and extract xml from it
            $response = Http::get(config('global.ext_api.teams.url') . '.xml');
            $xml_response = new TeamXMLData($response);
            $xml_response->extractData();

            //Parse YAML file and get xml mapper from it
            $mapper = Yaml::parseFile(config_path('mappers/team.yaml'))['xml'];

            //Get teams data and save into database
            $collection = new TeamsXMLCollection($xml_response, $mapper);
            $collection->create();
            DB::beginTransaction();
            foreach ($collection->teams as $team) {
                $team->save();
            }
            DB::commit();
            return 'successful';
        } 
        catch (Exception $exc) 
        {
            DB::rollBack();
            return 'failed';
        }
    }
}
