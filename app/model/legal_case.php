<?php

class legal_case
{
    public static function getlegal_cases()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("select * from legal_case");
        $izraz->execute();
        return $izraz->fetchAll();
    }
}
