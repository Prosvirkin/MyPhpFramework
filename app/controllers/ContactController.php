<?php


namespace app\controllers;


use vendor\core\base\View;

class ContactController extends AppController
{

    public function indexAction()
    {
        $title = 'Contact page';
        $this->set(compact("title"));
    }

}