<?php

require_once __DIR__."/vendor/autoload.php";

use App\Application;
use App\Controllers\SiteController;
$root_path = __DIR__;

    $app = new Application($root_path);


    /*
     $app->router->get("/",function(){
        return "Hello world";
    });

    $app->router->get("/contacts",function(){
        return "Contact us";
    });
    */

    $app->router->get("/",'home');

    $app->router->get("/contacts",[SiteController::class,'contact']);

    $app->router->post("/contacts", [SiteController::class,'submitContact']);

    $app->run();