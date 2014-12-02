<?php
/**
 * Created by PhpStorm.
 * User: adrienbrussolo
 * Date: 02/12/14
 * Time: 13:05
 */

namespace Interfaces;


interface iRoutable {

    public function getController();
    public function getAction();
    public function getParams($matches);
    public function isMatch($pattern, $url);

} 