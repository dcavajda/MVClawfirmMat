<?php

class lawyerController extends Controller
{


    public function index()
    {

        $this->view->render("privatno/lawyer/index");
    }

}