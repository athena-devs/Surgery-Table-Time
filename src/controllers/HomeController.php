<?php

namespace Src\Controllers;
class HomeController
{
    public function index()  {
        $json = [
            "message" => "ok"
        ];
        echo json_encode($json);
    }    
}

?>