<?php

class Legal_casesController extends Controller
{

    private $viewGreska="";
    private $id=0;


    public function index()
    {  
        $this->view->render("privatno/legal_cases/index",
            ["legal_cases"=>Legal_case::getlegal_cases()]);
    }



    public function pripremaNovi()
    {
        $this->view->render("privatno/legal_cases/novi");
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
        App::setParams(Legal_case::read($id));
        $this->view->render("privatno/legal_cases/promjeni", ['id'=>$id]);
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
        if(!$this->kontrolaLegal_case_code()){
            return;
        }
        
        if(!$this->kontrolaCase_date_start()){
            return;
        }

        if(!$this->kontrolaCase_date_end()){
            return;
        }

        

    return true;
    }

    private function kontrolaLegal_case_code()
    {

        if(trim(App::param('legal_case_code'))===''){
            $this->greska('legal_case_code','must add Legal case code');
            return false;
        }
    
        
    return true;
    }

    private function kontrolaCase_date_start()
    {


        if(trim(App::param('case_date_start'))===''){
            $this->greska('case_date_start','must add date');
            return false;
       }
       

       return true;
    }   
    
    private function kontrolaCase_date_end()
    {
       if(trim(App::param('case_date_end'))===''){
        $this->greska('case_date_end','must add date');
        return false;
        }

       
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

    

