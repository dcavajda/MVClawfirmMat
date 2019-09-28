<?php

class Legal_case
{
    public static function getlegal_cases()
    {

        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        select * from legal_case;
      
        /* ne radi sql 
        select a.legal_case_id, a.client, a.legal_case_code, a.case_date_start, a.case_date_end,
		b.firstname,b.lastname,b.IBAN,b.OIB
        from legal_case a inner join lawyer b
        on a.lawyer=b.lawyer_id 
        where a.legal_case_id=:legal_case
        */

        ");


        $izraz->execute();
        return $izraz->fetchAll();
    }


    public static function read($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("

        select * from legal_case where legal_case_id=:legal_case
        
        ");
        $izraz->execute(['legal_case'=>$id]);
        return $izraz->fetch(PDO::FETCH_ASSOC);

    }


    public static function novi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        insert into legal_casase values
        (null,:legal_case_code,:case_date_start,:case_date_end)
        
        ");
        $izraz->execute($_POST);
    }

    public static function promjeni($id)
    {   
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        update legal_case set
        legal_case_code=:legal_case_code,
        case_date_start=:case_date_start,
        case_date_end=:case_date_end
        where legal_case_id=:legal_case_id
        
        ");
        $_POST['legal_case_id']=$id;
        $izraz->execute($_POST);
    }



    public static function brisi($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        delete from legal_case where legal_case_id=:legal_case_id
        
        ");
        $izraz->execute(['legal_case_id'=>$id]);
    }


}
