<?php

namespace Somms\PHPKew\POWO;

use Somms\PHPKew\API\API;
use Somms\PHPKew\API\SearchResult;

class POWOApi extends API
{

    public function __construct()
    {
        parent::__construct(parent::POWO_URL);
    }

    public function Search($query, $filters = null){
        return new SearchResult($this, $query, $filters);
    }

    public function Lookup($id, $include=null) {
        $params = ($include) ? ['fields' => implode(',', $include)] : [];
        return $this->get('taxon/' . $id, $params);
    }
}