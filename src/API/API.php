<?php

namespace Somms\PHPKew\API;

use duzun\hQuery;

abstract class API
{
    public const IPNI_URL = 'http://beta.ipni.org/api/1';
    public const POWO_URL = 'http://www.plantsoftheworldonline.org/api/2';
    public const KPL_URL = 'http://kewplantlist.org/api/v1';

    private $_base_url;

    public function __construct($url) {
        $this->_base_url = $url;
    }

    private function getUrl($method, $params) {
        return $this->_base_url . '/' . $method . '?' . http_build_query($params);
    }

    public function get($method, $params = array()) {
        $url = $this->getUrl($method, $params);
        //echo $url . " ";

        // @var $doc hQuery
        $doc = hQuery::fromUrl($url, ['Accept' => 'text/html,application/xhtml+xml;q=0.9,*/*;q=0.8']);
        //echo " " . $doc->read_time . "\r\n";
        $result = json_decode($doc, true);
        $result['elapsed'] = $doc->read_time;
        return $result;
    }
}