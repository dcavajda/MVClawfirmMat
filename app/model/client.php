<?php

class client
{
    public static function getclients()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("select * from client");
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function novi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        insert into client values
        (null,:firstname,:lastname,:IBAN,:OIB)
        
        
        ");
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


}
