<?php


namespace app\controllers;

use app\models\Main;

class BusController extends AppController
{
    public function setBusAction() {
        header('Content-Type: application/json');
        new Main();
        $this->layout = 'main';
        if($_SERVER['CONTENT_TYPE'] === 'application/json;charset=utf-8') {
            \R::wipe('buses');
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            foreach ($data as $bus) {
                $buslist = \R::dispense('buses');
                $buslist->busName = $bus['busName'];
                $buslist->countPlace = $bus['countPlace'];
                $buslist->driveHome = $bus['driveHome'];
                \R::store($buslist);
            }
        }
    }

    public function getBusAction() {
        header('Content-Type: application/json');
        new Main();
        $this->layout = 'main';
        $buses = \R::findAll('buses');
        $buses = json_encode($buses);
        $buses = preg_replace("#\"[0-9]\":#", "", $buses);
        $buses = preg_replace("#{{#", "[{", $buses);
        $buses = preg_replace("#}}#", "}]", $buses);
        echo $buses;
    }

}