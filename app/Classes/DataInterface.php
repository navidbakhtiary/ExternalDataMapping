<?php

namespace App\Classes;

interface DataInterface
{
    public function extractData();
    public function hasData();
    public function mapObjectToModel(object $object);
}