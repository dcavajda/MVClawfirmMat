<?php

class legal_traineesController extends Controller
{

    public function index()
    {
        $this->view->render("privatno/legal_trainees/index",
        ["legal_trainees"=>legal_trainee::getlegal_trainees()]);

    }

}