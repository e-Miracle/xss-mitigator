<?php

namespace Project\Request;

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
        foreach ($_REQUEST as $key => $value) {
            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                //this makes is dynamically available
                $this->$key = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                //this collects it
                $this->data->$key = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                foreach ($_POST as $key => $value) {
                    $this->$key = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    $this->data->$key = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }else{
                $this->$key = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                $this->data->$key = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
    }

    public function data($x = null): stdClass
    {
        return $x?$this->data->$x:$this->data;
    }
}