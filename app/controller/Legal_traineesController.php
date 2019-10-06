<?php

class Legal_traineesController extends Controller
{

    public function index()
    {
        $this->view->render("privatno/legal_trainees/index",
        ["legal_trainees"=>Legal_trainee::getLegal_trainees()]);

    }

}