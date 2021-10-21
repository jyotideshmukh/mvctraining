<?php


namespace App;

/**
 * Class Controller
 * @package App
 */
class Controller
{
    public function render($view){
        return Application::$app->router->renderView('contacts');
    }

}