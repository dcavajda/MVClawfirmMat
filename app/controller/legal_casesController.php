<?php

class legal_casesController extends Controller
{


    public function index()
    {
        $this->view->render("privatno/legal_cases/index",
        ["legal_cases"=>legal_case::getlegal_cases()]);
    }

}