<?php

namespace Somms\PHPKew\API;

use ArrayIterator;


class SearchResult extends ArrayIterator
{
    private $query;
    private $filters;
    private $api;
    private $cursor;

    public ArrayIterator $results;

    public $response;
    private float $waitTime;

    public function __construct($api, $query, $filters = null) {

        parent::__construct();
        $this->query = $query;
        $this->filters = $filters;
        $this->api = $api;
        $this->cursor = "*";
        $this->runQuery();
    }

    private function buildParams() {
        $params = array('perPage' => 500, 'cursor' => $this->cursor);
        if ($this->query) {
            $params['q'] = $this->formatQuery();
        }
        if ($this->filters) {
            $params['f'] = $this->formatFilters();
        }
        return $params;
    }

    private function formatQuery() {
        if (is_array($this->query)) {
            $terms = array();
            foreach ($this->query as $key => $value) {
                $terms[] = $key . ':' . $value;
            }
            return implode(",", $terms);
        } else {
            return $this->query;
        }
    }

    private function formatFilters() {
        if (is_array($this->filters)) {
            return implode(",", $this->filters);
        } else {
            return $this->filters;
        }
    }

    private function runQuery() {
        $params = $this->buildParams();
        $response = $this->api->get('search', $params);
        $this->waitTime = $response['elapsed'] / 2.0;
        $this->response = $response;
        if (array_key_exists('results', $this->response)) {
            $this->results = new ArrayIterator($this->response['results']);
        }
        if (array_key_exists('cursor', $this->response)) {
            $this->cursor = $this->response['cursor'];
        }
    }

    public function current() {
        return $this->results->current();
    }

    public function next() {
        $this->results->next();
        if (!$this->results->valid()) {
            sleep($this->waitTime);
            $this->runQuery();
        }
    }

    public function key() {
        return $this->results->key();
    }

    public function valid() {
        return $this->results->valid();
    }

    public function rewind() {
        $this->results->rewind();
    }

    public function size() {
        if (array_key_exists('totalResults', $this->response)) {
            return $this->response['totalResults'];
        } else {
            return 0;
        }
    }
}