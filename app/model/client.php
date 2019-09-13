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
}
