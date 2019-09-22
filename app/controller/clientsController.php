<?php

class ClientsController extends Controller
{

    private $viewGreska="";
    private $id=0;


    public function index()
    {  
        $this->view->render("privatno/clients/index",
            ["clients"=>Client::getclients()]);
    }



    public function pripremaNovi()
    {
        $this->view->render("privatno/clients/novi");
    }


    public function novi()
    {  
       //tu dođu kontrole
      if(!$this->kontrole()){
          return;
      }
       Client::novi();
       $this->index();
    }



    public function pripremaPromjeni($id)
    {
        App::setParams(Client::read($id));
        App::param('firstname',str_replace('.',',',App::param('firstname')));
        App::param('lastname',str_replace('.',',',App::param('lastname')));
        $this->view->render("privatno/clients/promjeni", ['id'=>$id]);
    }


    public function promjeni($id)
    {
        $this->viewGreska="privatno/clients/promjeni";
        $this->id=$id;

        if(!$this->kontrole()){
            return;
        }
  
         Client::promjeni($id);
         $this->index();
    }





    public function brisanje($id)
    {  
       Client::brisi($id);
       $this->index();
    }


    private function kontrole(){
        if(trim(App::param('firstname'))===''){
            $this->greska('firstname','must add Firstname');
            return false;
        }
    

        if(strlen(App::param('firstname'))>50){
            $this->greska('firstname','no more than 50 letters (now: ' . 
            strlen(App::param('firstname')) . ')');
            return false;
        }
    
    
        if(trim(App::param('lastname'))===''){
            $this->greska('lastname','must add lastname');
            return false;
       }
       
       if(strlen(App::param('lastname'))>50){
        $this->greska('lastname','no more than 50 letters (now: ' . 
        strlen(App::param('lastname')) . ')');
        return false;
       } 

       if(trim(App::param('IBAN'))===''){
        $this->greska('IBAN','must add IBAN');
        return false;
        }

        if(strlen(App::param('IBAN'))>21){
            $this->greska('IBAN','must be 21 signs (now: ' . 
            strlen(App::param('IBAN')) . ')');
            return false;
        } 

        if(trim(App::param('OIB'))===''){
            $this->greska('OIB','must add OIB');
            return false;
            }

    return true;

}


    private function greska($polje,$poruka){
        $this->view->render("privatno/clients/novi",
            ['greska'=>
                ['polje'=>$polje,
                 'poruka'=>$poruka]
            ]);
    }

    

    



}

    

