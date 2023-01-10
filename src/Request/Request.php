<?php

namespace CssFuto\ProjectXssMitigator\Request;

use CssFuto\ProjectXssMitigator\Purifier\Purifier;
use stdClass;

class Request
{
    private $data;
    public function __construct()
    {
        $this->data = new stdClass;
        $this->setData();
    }

    private function setData(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            foreach ($_REQUEST as $key => $value) {
                $this->data->$key = filter_input(INPUT_GET, $value, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
            foreach ($_REQUEST as $key => $value) {
                $this->data->$key = filter_input(INPUT_GET, $value, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        else{
            foreach ($_REQUEST as $key => $value) {
                $this->data->$key = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
    }

    public function data($x = null): stdClass
    {
        return $x?$this->data->$x:$this->data;
    }

    public function purifyDatum($dirty_html_input_name): string
    {
        return (new Purifier())->purify($this->data->$dirty_html_input_name);
    }

    public function __get(string $name)
    {
        // TODO: Implement __get() method.
        return $this->data->$name;
    }
}