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
        if($legal_case["case_date_start"]!= null){
            $legal_case["case_date_start"] = date("d. m. Y.",strtotime($legal_case["case_date_start"])); 
        }
        
        $legal_case = Legal_case::read($id);
        if($legal_case["case_date_end"]!= null){
            $legal_case["case_date_end"] = date("d. m. Y.",strtotime($legal_case["case_date_end"]));
        }

      App::setParams($legal_case);
       $this->view->render("privatno/legal_cases/promjeni", 
       ['id'=>$id,
       "clients"=>Client::getClients(),
       "lawyers"=>Lawyer::getLawyers()]);

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

    

