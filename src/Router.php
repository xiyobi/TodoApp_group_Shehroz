<?php
namespace App;
class Router
{
    public $currentRounte;
    public function __construct(){
        $this->currentRounte=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    }

    public function getResourser($route){
        $resourceIndex = mb_stripos($route, '{id}');
        if (!$resourceIndex) {
            return false;
        }
        $resourceValue =substr($this->currentRounte,$resourceIndex);
        if ($limit = mb_stripos($resourceValue, '/')) {
            return substr($resourceValue, 0, $limit);
        }
        return $resourceValue ? $resourceValue : false;

    }

    public function get($route,$callback){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $resourceValue = $this->getResourser($route);

            if ($resourceValue) {
                $resourceRoute = str_replace('{id}', $resourceValue, $route);
                if ($resourceRoute == $this->currentRounte) {
                    $callback($resourceValue);
                    exit();
                }
            }
            if ($route == $this->currentRounte) {
                $callback();
                exit();
            }
        }

    }

    public function post($route,$callback)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resourceValue = $this->getResourser($route);
            if ($resourceValue) {
                $resourceRoute = str_replace('{id}', $resourceValue, $route);
                if ($resourceRoute == $this->currentRounte) {
                    $callback($resourceValue);
                    exit();
                }
            }
            if ($route == $this->currentRounte) {
                $callback();
                exit();
            }
        }
    }
    public function put($route, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['_method']) && $_POST['_method'] == 'PUT') {
                $resourceValue = $this->getResourser($route);
                if ($resourceValue) {
                    $resourceRoute = str_replace('{id}', $resourceValue, $route);
                    if ($resourceRoute == $this->currentRounte) {
                        $callback($resourceValue);
                        exit();
                    }
                }
                if ($route == $this->currentRounte) {
                    $callback();
                    exit();
                }

            }
        }

    }

    public function delete($route, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['_method']) && $_POST['_method'] == 'DELETE') {
                $resourceValue = $this->getResourser($route);
                if ($resourceValue) {
                    $resourceRoute = str_replace('{id}', $resourceValue, $route);
                    if ($resourceRoute == $this->currentRounte) {
                        $callback($resourceValue);
                        exit();
                    }
                }
                if ($route == $this->currentRounte) {
                    $callback();
                    exit();
                }

            }
        }

    }

    public function isApiCall(): bool
    {
        return mb_stripos($this->currentRounte, '/api') === 0;
}
public function isTelegram()
    {
        return mb_stripos($this->currentRounte, '/telegram') === 0;
}

}