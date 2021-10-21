<?php
namespace App;
/**
 * Class Request
 * @package App
 */
class Request
{
    public function getPath(){
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path,"?") ?? false;

        if($position === false){
            return $path;
        }
        return substr($_SERVER['REQUEST_URI'],0, $position);
    }

    public function getMethod(){

        return strtolower($_SERVER['REQUEST_METHOD'] )?? false;
    }
}