<?php

namespace Somms\PHPKew\KPL;

use Somms\PHPKew\API\API;
use Somms\PHPKew\API\SearchResult;

class KPLApi extends API
{

    public function __construct()
    {
        parent::__construct(parent::KPL_URL);
    }

    public function Search($query, $filters = null){
        return new SearchResult($this, $query, $filters);
    }

    public function Lookup($id) {
        return $this->get('taxon/' . $id);
    }
}