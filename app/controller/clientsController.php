<?php

class clientsController extends Controller
{


    public function index()
    {

        $this->view->render("privatno/clients/index",
        ["clients"=>client::getclients()]);

    }


}

