<?php

class legal_trainee
{
    public static function getlegal_trainees()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("select * from legal_trainee");
        $izraz->execute();
        return $izraz->fetchAll();
    }
}
