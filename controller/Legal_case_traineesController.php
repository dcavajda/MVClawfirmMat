<?php

class Legal_case_traineesController extends Controller
{


    public function index()
    {

        $this->view->render("privatno/legal_case_trainees/index",
        ["legal_case_trainees"=>Legal_case_trainee::getLegal_case_trainees()]);
    }

}