<?php
namespace App;
use App\Request;

/**
 * Class Router
 * @package App
 */
class Router
{
    protected array $routes = [];
    public Request $request;
    public Response  $response;

    /**
     * Router constructor.
     * @param array $routes
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param $path
     * @param $callback
     */
    public function get($path, $callback){

        $this->routes['get'][$path] = $callback;
    }

    /**
     * @param $path
     * @param $callback
     */
    public function post($path, $callback){

        $this->routes['post'][$path] = $callback;
    }

    /**
     * @return array|false|mixed|string|string[]
     */
    public function resolve(){
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
       /*echo "<pre>",
            var_dump($this->routes),
            var_dump($callback);
        exit;*/
        if($callback === false){
            $this->response->setStatusCode(404);
            $layoutContent  = $this->renderLayout();
            $viewContent =  $this->renderViewContent("Not Found");
            return str_replace("{{ content }}",$viewContent,$layoutContent);
        }

        if(is_string($callback)){

            return $this->renderView($callback);

        }
        if(is_array($callback)){
            //$callback[0] == SiteController
            $callback[0] = new $callback[0]();

        }

       /* echo "<pre>", print_r($this->routes),
        print_r($callback);
        exit;*/
        return call_user_func($callback);
    }

    /**
     * @param $view
     * @return array|false|string|string[]
     */
    public function renderView($view){
        $layoutContent  = $this->renderLayout();
        $viewContent =  $this->renderViewOnly($view);
        return str_replace("{{ content }}",$viewContent,$layoutContent);
    }

    /**
     * @param $view
     * @return false|string
     */
    public function renderViewOnly($view){
         ob_start();
         include_once Application::$ROOT_DIR."/templates/$view.php";
         return ob_get_clean();
    }

    /**
     * @return false|string
     */
    public function renderLayout(){
        ob_start();
        include_once Application::$ROOT_DIR."/templates/layouts/layout.php";
        return ob_get_clean();
    }

    /**
     * @param $content
     * @return mixed
     */
    public function renderViewContent($content){
        return $content;
    }
}