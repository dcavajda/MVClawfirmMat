<?php

class ClientsController extends Controller
{

    public function index()
    {  
        $this->view->render("privatno/clients/index",
            ["clients"=>client::getclients()]);
    }

    public function pripremaNovi()
    {
        $this->view->render("privatno/clients/novi");
    }

    public function novi()
    {  
       //tu dođu kontorle
       Client::novi();
       $this->index();
    }

    public function brisanje($id)
    {  
       Client::brisi($id);
       $this->index();
    }

}