<?php
/**
 * Created by PhpStorm.
 * User: adrienbrussolo
 * Date: 01/12/2014
 * Time: 12:27
 */

namespace Router;

use Symfony\Component\Yaml\Exception\RuntimeException;

class Router implements \Countable {

    protected $routes;

    //$route = $route->getRoute('/php-route-2015/2');
    // $route->getController() ...

    public function __construct(){

        $this->routes = new \SplObjectStorage();

    }

    public function count(){

        return count($this->routes);

    }

    public function addRoute(iRoutable $route){


        if ($this->routes->contains($route)){

            throw new \RuntimeException('cannot overide route');

        }

        $this->routes->attach($route);

    }

    public function getRoute($url){

        // on va chercher toutes les routes dans le storage

        foreach($this->routes as $route){

            if ($route->isMatch($url)){

                return $route;

            }

       }

        throw new \RuntimeException('bad url');

    }

} 