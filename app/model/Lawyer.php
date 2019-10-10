<?php

class Lawyer
{
    public static function getLawyers()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        select 
        a.lawyer_id, a.firstname, a.lastname, a.IBAN, a.OIB, a.opis,
        concat(a.firstname,' ',a.lastname) as firstnamelastname,
        count(b.legal_case_id) as ukupno
        from lawyer a left join legal_case b
        on a.lawyer_id=b.lawyer
        group by a.lawyer_id, a.firstname, a.lastname, a.IBAN, a.OIB, a.opis
        order by a.firstname
        
        ");
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select * from lawyer where lawyer_id=:lawyer
        
        ");
        $izraz->execute(['lawyer'=>$id]);
        return $izraz->fetch(PDO::FETCH_ASSOC);

    }




    public static function novi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        insert into lawyer
        (lawyer_id, firstname, lastname, IBAN, OIB, opis)
        values
        (null, :firstname, :lastname, :IBAN, :OIB, :opis)
        
        ");
        $izraz->execute($_POST);
    }



    public static function promjeni($id)
    {   
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        update lawyer set
        firstname=:firstname,
        lastname=:lastname,
        OIB=:OIB,
        IBAN=:IBAN,
        opis=:opis
        where lawyer_id=:lawyer_id
        
        ");
        $_POST['lawyer_id']=$id;
        $izraz->execute($_POST);
    }



    public static function brisi($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        delete from lawyer where lawyer_id=:lawyer_id
        
        ");
        $izraz->execute(['lawyer_id'=>$id]);
    }

    public static function isDeletable($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select count(legal_case_id) from legal_case where lawyer=:lawyer
        
        ");
        $izraz->execute(['lawyer'=>$id]);
        $ukupno = $izraz->fetchColumn();
        return $ukupno==0;


    }


}
