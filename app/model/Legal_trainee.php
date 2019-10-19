<?php

class Legal_trainee
{
    public static function getLegal_trainees()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("

        select a.legal_trainee_id, a.firstname, a.lastname, a.IBAN, a.OIB, 
        b.legal_case_id
        from legal_trainee a
        left join legal_case_trainee b on a.legal_trainee_id=b.legal_trainee_id
        
        

        ");
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select legal_trainee_id, firstname, lastname, IBAN, OIB from legal_trainee where legal_trainee_id=:legal_trainee
        
        ");
        $izraz->execute(['legal_trainee'=>$id]);
        return $izraz->fetch(PDO::FETCH_ASSOC);

    }

    public static function getLegal_traineesNaLegal_cases($legal_case)
    {
       
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select a.legal_trainee_id, a.firstname, a.lastname, a.IBAN, a.OIB, 
        b.legal_case_id
        from legal_trainee a
        left join legal_case_trainee b on a.legal_trainee_id=b.legal_trainee_id

        ");
        $izraz->execute(["legal_case"=>$legal_case]);
        return $izraz->fetchAll();
    }

    public static function getTraziLegal_trainees($uvjet)
    {

        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        select a.legal_trainee_id, a.firstname, a.lastname, a.IBAN, a.OIB, 
        b.legal_case_id
        from legal_trainee a
        left join legal_case_trainee b on a.legal_trainee_id=b.legal_trainee_id    
        where concat(a.firstname, a.lastname) like :uvjet
        " 
    
        );
        $izraz->execute(["uvjet"=>"%" . $uvjet . "%"]);
        return $izraz->fetchAll();
    }






    public static function novi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        insert into legal_trainee values
        (null,:firstname,:lastname,:OIB,:IBAN)
        
        ");
        $izraz->execute($_POST);
    }



    public static function promjeni($id)
    {   
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        update legal_trainee set
        firstname=:firstname,
        lastname=:lastname,
        OIB=:OIB,
        IBAN=:IBAN
        where legal_trainee_id=:legal_trainee_id
        
        ");
        $_POST['legal_trainee_id']=$id;
        $izraz->execute($_POST);
    }



    public static function brisi($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        delete from legal_trainee where legal_trainee_id=:legal_trainee_id
        
        ");
        $izraz->execute(['legal_trainee_id'=>$id]);
    }


}
