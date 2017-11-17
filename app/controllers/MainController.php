<?php

namespace app\controllers;

use app\models\Main;
use vendor\core\base\Model;
use vendor\core\base\View;

class MainController extends AppController
{

    public function indexAction()
    {
        $title = 'Main page';
        $this->set(compact("title"));
    }


}