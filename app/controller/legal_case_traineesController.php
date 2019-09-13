<?php

class legal_case_traineesController extends Controller
{


    public function index()
    {

        $this->view->render("privatno/legal_case_trainees/index",
        ["legal_case_trainees"=>legal_case_trainee::getlegal_case_trainees()]);
    }

}