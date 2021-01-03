<?php


namespace app\controllers;


use app\models\Main;

class PeopleController extends AppController
{
    public function setPeopleAction() {
        header('Content-Type: application/json');
        new Main();
        if($_SERVER['CONTENT_TYPE'] === 'application/json;charset=utf-8') {
            \R::wipe('people');
            $this->layout = 'main';
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            foreach ($data as $person) {
                $peoplelist = \R::dispense('people');
                $peoplelist->peopleBus = $person['peopleBus'];
                $peoplelist->peopleName = $person['peopleName'];
                $peoplelist->peoplePlace = $person['peoplePlace'];
                $peoplelist->peopleWhere = $person['peopleWhere'];
                \R::store($peoplelist);
            }
        }
    }

    public function getPeopleAction() {
        header('Content-Type: application/json');
        new Main();
        $this->layout = 'main';
        $people = \R::findAll('people');
        $people = json_encode($people, JSON_UNESCAPED_UNICODE);
        $people = preg_replace("#\"[0-9]+\":#", " ", $people);
        $people = preg_replace("#{ {#", "[{", $people);
        $people = preg_replace("#}}#", "}]", $people);
        echo $people;
    }

}