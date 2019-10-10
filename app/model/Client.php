<?php

class Client
{
    public static function getClients($stranica=0)
    {

        if($stranica>0){
            $sps = App::config("stavakaPoStranici");
            $odKuda=($stranica -1) * $sps;
            $limit = "limit " . $odKuda . ", " . $sps;
        }else{
            $limit="";
        }
        
        $veza = DB::getInstance();
        $izraz = $veza->prepare(" select 
        a.client_id, a.firstname, a.lastname, a.IBAN, a.OIB,
        concat(a.firstname,' ',a.lastname) as firstnamelastname,
        count(b.legal_case_id) as ukupno
        from client a left join legal_case b
        on a.client_id=b.client
        where concat(firstname,lastname,ifnull(OIB,'')) like :uvjet
        group by a.client_id, a.firstname, a.lastname, a.IBAN, a.OIB
        order by firstname
        
        " . $limit
        );
        $izraz->execute(["uvjet"=>"%" . App::param("uvjet") . "%"]);
        return $izraz->fetchAll();

    }


    /* NEMOGU
    public static function getClients()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("select * from client");
        $izraz->execute();
        return $izraz->fetchAll();
    }
    */


    public static function read($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select * from client where client_id=:client


        ");
        $izraz->execute(['client'=>$id]);
        return $izraz->fetch(PDO::FETCH_ASSOC);

    }

    public static function novi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        insert into client 
        (client_id, firstname, lastname, IBAN, OIB )
        values
        (null,:firstname,:lastname,:IBAN,:OIB)
        
        ");
        $izraz->execute($_POST);
    }

    

    public static function promjeni($id)
    {   
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        

        update client set
        firstname=:firstname,
        lastname=:lastname,
        OIB=:OIB,
        IBAN=:IBAN
        
        where client_id=:client_id
        
        ");
        $_POST['client_id']=$id;
        $izraz->execute($_POST);
    }


    public static function brisi($id) 
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
            
        delete from client where client_id=:client_id
            
        ");
        $izraz->execute(['client_id'=>$id]);
    }
  
    public static function isDeletable($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select count(legal_case_id) from legal_case where client=:client
        ");

        $izraz->execute(['client'=>$id]);
        $ukupno = $izraz->fetchColumn();
        return $ukupno==0;
    }


    public static function ukupnoStranica()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select count(client_id) from client
        where concat(firstname,lastname,ifnull(OIB,'')) like :uvjet
        ");
        $izraz->execute(["uvjet"=>"%" . App::param("uvjet") . "%"]);
        $ukupno = $izraz->fetchColumn();
        return ceil($ukupno/App::config("stavakaPoStranici"));
    }

   

}
