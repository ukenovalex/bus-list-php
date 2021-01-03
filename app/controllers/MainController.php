<?php
namespace app\controllers;



use app\models\Main;
use R;
use vendor\core\App;

class MainController extends AppController
{
    public function indexAction()
    {
        $model = new Main();
    }

    public function testAction()
    {

    }
}