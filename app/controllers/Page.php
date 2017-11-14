<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 14.11.2017
 * Time: 21:11
 */

namespace app\controllers;

class Page extends App
{

    public function indexAction(){
        echo "Page::index";
    }

    public function viewAction(){
        debug($this->route);
        echo "Page:: viewAction";
    }

}