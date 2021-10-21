<?php
//require_once __DIR__."/Router.php";
//require_once __DIR__."/Request.php";
namespace App;

use App\Request;
use App\Response;
use App\Router;

/**
 * Class Application
 * @package App
 */
class Application
{
    public static $ROOT_DIR;
    public Router $router;
    public Request  $request;
    public Response  $response;
    public static Application $app;

    /**
     * Application constructor.
     */
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request,$this->response);
    }

    public function run(){
        echo $this->router->resolve();
    }
}