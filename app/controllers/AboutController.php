<?php

namespace app\controllers;


use vendor\core\base\View;

class AboutController extends AppController
{

    public function indexAction()
    {
        $title = 'About page';
        $this->set(compact("title"));
    }
}