<?php

class Operater
{
    public static function getOperateri()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("select operater_id, firstname ,lastname, email, uloga from operater");
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select operater_id, firstname ,lastname, email, uloga from operater where operater_id=:operater
        ");
        $izraz->execute(['operater'=>$id]);
        return $izraz->fetch(PDO::FETCH_ASSOC);

    }


    public static function novi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("

        insert into operater 
        (operater_id, firstname, lastname, email, uloga)
        values
        (null, :firstname, :lastname, :email, :uloga)
        
        ");
        
        $izraz->execute($_POST);
    }

    public static function promjeni($id)
    {   
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        update operater set
        firstname=:firstname,
        lastname=:lastname,
        email=:email,
        uloga=:uloga
        where operater_id=:operater_id
        
        ");
        $_POST['operater_id']=$id;
        $izraz->execute($_POST);
    }



    public static function brisi($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        delete from operater where operater_id=:operater_id
        
        ");
        $izraz->execute(['operater_id'=>$id]);
    }


}
