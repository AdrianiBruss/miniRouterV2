<?php
/**
 * Created by PhpStorm.
 * User: adrienbrussolo
 * Date: 02/12/14
 * Time: 14:15
 */

namespace Router;


use Interfaces\iRoutable;
use Symfony\Component\Yaml\Exception\RuntimeException;



class Route implements iRoutable {

    protected $controller;
    protected $action;
    protected $params = null;
    protected $route; // pour garder le tableau de $route

    public function __construct(array $route){

        //on parse une  $route à la fois

        $this->route = $route;
        if (empty($route['connect'])){

            throw new \RuntimeException('bad syntax connect');

        }

        $this->setConnect($route['connect']);

    }

    public function setConnect($connect){

        $connect = explode(':', $connect);

        if (count($connect) !=2 ){

            throw new \RuntimeException('bad syntax connect');

        }

        $this->controller = $connect[0];
        $this->action = $connect[1];

    }

    public function getController(){

        // retourne le nom du controller
        return $this->controller;

    }

    public function getAction(){

        // retourne le nom de l'action
        return $this->action;

    }

    public function isMatch($pattern, $url){

        if ( preg_match('/^'.$this->route['pattern'].'$/',  $url, $matches)){

            $this->getParams($matches);
            return true;

        }else{

            return false;

        }

    }

    public function getParams($matches){

        if( empty($this->route['params']) ){

            return null;

        }else{

            foreach( explode(',', $this->route['params'] ) as $p){

                $p = trim($p);
                $this->params[] = $matches[$p];

            }

            return $this->params;

        }

    }

} 