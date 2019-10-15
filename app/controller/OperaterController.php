<?php

class OperaterController extends UlogaAdmin
{

    private $viewGreska="";
    private $id=0;

    public function __construct()
    {
        parent::__construct();
        if($_SESSION["autoriziran"]->uloga!="admin"){
            $this->view->render("login");
            exit;
        }
    }


    public function index()
    {  
        $this->view->render("privatno/operateri/index",
            ["operateri"=>Operater::getOperateri()]);
    }



    public function pripremaNovi()
    {
        $this->view->render("privatno/operateri/novi"
        );


    }


    public function novi()
    {  
        $this->viewGreska="privatno/operateri/novi";

       //tu dođu kontrole
      if(!$this->kontrole()){
          return;
      }
       Operater::novi();
       $this->index();
    }



    public function pripremaPromjeni($id)
    
    {
        App::setParams(Operater::read($id));
        $this->view->render("privatno/operateri/promjeni", ['id'=>$id]);
    }



    public function promjeni($id)
    {
        $this->viewGreska="privatno/operateri/promjeni";
        $this->id=$id;

        if(!$this->kontrole()){
            return;
        } 
         Operater::promjeni($id);
         $this->index();
         
    }

    

    public function brisanje($id)
    {  
       Operater::brisi($id);
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