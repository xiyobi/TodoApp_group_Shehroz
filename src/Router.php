<?php
namespace App;
class Router
{
    public $currentRounte;
    public function __construct(){
        $this->currentRounte=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    }

    public function getResourser(){
        if (isset(explode("/",$this->currentRounte)[2])){
            $resourceId=(int)explode("/",$this->currentRounte)[2];
            return $resourceId ? $resourceId : false;
        }
        return false;
    }

    public function get($route,$callback){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $resourceId=$this->getResourser();
            $route = str_replace('{id}',$resourceId, $route);
            if ($route == $this->currentRounte) {
                $callback($resourceId);
                exit();
            }
        }
    }

    public function post($route,$callback){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resourceId=$this->getResourser();
            $route = str_replace('{id}',$resourceId, $route);
            if ($route == $this->currentRounte) {
                $callback($resourceId);
                exit();
            }
        }
    }


    public function put($route, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['_method'] == 'PUT') {
                $resourceId=$this->getResourser();
                $route = str_replace('{id}',$resourceId, $route);
                if ($route == $this->currentRounte) {
                    $callback($resourceId);
                    exit();
                }
            }
        }

    }

}