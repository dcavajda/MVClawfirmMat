<?php

class Legal_casesController extends UlogaOperater
{

    private $viewGreska="";
    private $id=0;


    public function index()
    {  
        $this->view->render("privatno/legal_cases/index",
            ["legal_cases"=>Legal_case::getLegal_cases()]);
    }



    public function pripremaNovi()
    {
        $this->view->render("privatno/legal_cases/novi",
        ["clients"=>Client::getClients(),
        "lawyers"=>Lawyer::getLawyers()]
        );

//kada ubacim da mi prikaze client dobijem eror
        //["clients"=>Client::getClients(),
        //"lawyers"=>Lawyer::getLawyers()]
    }


    public function novi()
    {  
        $this->viewGreska="privatno/legal_cases/novi";

       //tu dođu kontrole
      if(!$this->kontrole()){
          return;
      }
       Legal_case::novi();
       $this->index();
    }



    public function pripremaPromjeni($id)
    
    {
        $legal_case = Legal_case::read($id);
      
        

      App::setParams($legal_case);

       $this->view->render("privatno/legal_cases/promjeni", 
       ['id'=>$id,
       "clients"=>Client::getClients(),
       "lawyers"=>Lawyer::getLawyers(),
       "legal_trainees"=>Legal_trainee::getLegal_traineesNaLegal_cases($id),  
       "cssFile"=>'<link rel="stylesheet" href="' . App::config("url") . 'public/css/jquery-ui.css">',
       "jsLib"=>'<script src="' . App::config("url") . 'public/js/vendor/jquery-ui.js"></script>',
       "javascript"=>'
       <script>var grupa=' . $id . ';</script>
       <script src="' . App::config("url") . 'public/js/grupe/skripta.js"></script>'
       ]);

    }



    public function promjeni($id)
    {
        $this->viewGreska="privatno/legal_cases/promjeni";
        $this->id=$id;

        if(!$this->kontrole()){
            return;
        } 
         Legal_case::promjeni($id);
         $this->index();
    }

    

    public function brisanje($id)
    {  
      

       Legal_case::brisi($id);
       $this->index();
    }




    private function kontrole()
    {
        return true;
    }


    private function greska($polje,$poruka){
        $this->view->render($this->viewGreska,
        ['greska'=>
            ['polje'=>$polje,
             'poruka'=>$poruka],
         'id'=>$this->id
        ]);
    }

    

}

    

