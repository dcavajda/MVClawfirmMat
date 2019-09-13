<?php

class lawyersController extends Controller
{


    public function index()
    {

        $this->view->render("privatno/lawyers/index",
        ["lawyers"=>lawyer::getlawyers()]);
    }

}
