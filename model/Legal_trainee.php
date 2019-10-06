<?php

class Legal_trainee
{
    public static function getLegal_trainees()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("select * from legal_trainee");
        $izraz->execute();
        return $izraz->fetchAll();
    }
}
