<?php

class Legal_case
{
    public static function getLegal_cases()
    {
       
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        select concat(c.firstname, ' ',c.lastname) as client,
        a.legal_case_id, a.legal_case_code, a.case_date_start, a.case_date_end,
        concat(b.firstname, ' ', b.lastname) as lawyer,
        e.legal_trainee_id
        from legal_case a 
        inner join lawyer b on a.lawyer=b.lawyer_id
        inner join client c on a.client=c.client_id
        left join legal_case_trainee e on e.legal_case_id=a.legal_case_id
        group by
        concat(c.firstname, ' ',c.lastname),
        a.legal_case_id, a.legal_case_code, a.case_date_start, a.case_date_end,
        concat(b.firstname, ' ', b.lastname)
        
        
        
        "
        );
        $izraz->execute();
        return $izraz->fetchAll();
    }

  
    public static function getClients()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        select client_id, firstname, lastname, IBAN, OIB from client
        ");
        $izraz->execute();
        return $izraz->fetchAll();
    }


    public static function read($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select legal_case_id, client, legal_case_code, case_date_start, case_date_end, lawyer
         from legal_case where legal_case_id=:legal_case
        ");
        $izraz->execute(['legal_case'=>$id]);
        return $izraz->fetch(PDO::FETCH_ASSOC);

    }


    public static function novi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        insert into legal_case 
        (legal_case_id, client, legal_case_code, case_date_start, case_date_end, lawyer)
        values
        (null,:client,:legal_case_code,:case_date_start,:case_date_end,:lawyer)
        
        ");
        $izraz->bindParam("client",$_POST["client"]);
        $izraz->bindParam("legal_case_code",$_POST["legal_case_code"]);
        $izraz->bindParam("case_date_start",$_POST["case_date_start"]);
        $izraz->bindParam("lawyer",$_POST["lawyer"]);
        if($_POST["case_date_end"]==""){
            $izraz->bindValue("case_date_end",null);
        }else{
            $izraz->bindParam("case_date_end",$_POST["case_date_end"]);
        }
        
        $izraz->execute();
    }


    public static function promjeni($id)
    {   
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        update legal_case set
        client=:client,
        legal_case_code=:legal_case_code,
        case_date_start=:case_date_start,
        case_date_end=:case_date_end,
        lawyer=:lawyer
        where legal_case_id=:legal_case_id
        
        ");
        $_POST['legal_case_id']=$id;
        $izraz->execute($_POST);

        $izraz->bindParam("client",$_POST["client"]);
        $izraz->bindParam("legal_case_code",$_POST["legal_case_code"]);
        $izraz->bindParam("case_date_start",$_POST["case_date_start"]);
        $izraz->bindParam("lawyer",$_POST["lawyer"]);
        if($_POST["case_date_end"]==""){
            $izraz->bindValue("case_date_end",null);
        }else{
            $izraz->bindParam("case_date_end",$_POST["case_date_end"]);
        }
        
        $izraz->execute();
    }




    public static function brisi($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        delete from legal_case where legal_case_id=:legal_case_id
        
        ");
        $izraz->execute(['legal_case_id'=>$id]);
    }

    public static function isDeletable($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select count(lawyer) from lawyer where legal_case=:legal_case
        
        ");
        $izraz->execute(['legal_case'=>$id]);
        $ukupno = $izraz->fetchColumn();
        return $ukupno==0;

    }


}
