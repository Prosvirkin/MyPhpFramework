<?php

namespace app\controllers;

class PostEdit extends App
{
    public function indexAction()
    {
        echo "postsEdit index";
    }

    public function testAction()
    {
        echo "post-edit test";
    }

    public function testPageAction()
    {
        echo "post-edit testPage";
    }

    public function before()
    {
        echo "before";
    }
}