<?php

class Legal_case_trainee
{
    public static function getLegal_case_trainees()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("select * from legal_case_trainee");
        $izraz->execute();
        return $izraz->fetchAll();
    }
}
