<?php

class clientsController extends Controller
{


    public function index()
    {

        $this->view->render("privatno/clients/index",
    
        ["clients"=>Client::getClients()]);
    }

    public function pripremanovi()
    {
        $this->view->render("privatno/clients/novi");
    }

    public function novi()
    {  
       //tu dođu kontorle
       Client::novi();
       $this->index();
    }


}

