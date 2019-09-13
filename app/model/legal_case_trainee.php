<?php

class legal_case_trainee
{
    public static function getlegal_case_trainees()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("select * from legal_case_trainee");
        $izraz->execute();
        return $izraz->fetchAll();
    }
}
