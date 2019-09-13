<?php

class lawyer
{
    public static function getlawyers()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("select * from lawyer");
        $izraz->execute();
        return $izraz->fetchAll();
    }
}
