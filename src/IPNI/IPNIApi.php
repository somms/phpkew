<?php

namespace Somms\PHPKew\IPNI;

use Somms\PHPKew\API\API;
use Somms\PHPKew\API\SearchResult;

class IPNIApi extends API
{

    public function __construct()
    {
        parent::__construct(parent::IPNI_URL);
    }

    public function Search($query, $filters = null){
        return new SearchResult($this, $query, $filters);
    }

    public function LookupName($id) {
        return $this->get('n/' . $id);
    }

    public function LookupAuthor($id) {
        return $this->get('a/' . $id);
    }

    public function LookupPublication($id) {
        return $this->get('p/' . $id);
    }
}