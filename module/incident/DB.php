<?php
require_once "./db/CrudDB.php";
require_once "./db/ConfigurationDB.php";
require_once "./db/EquipementDB.php";
require_once "./db/FichierConfigDB.php";
require_once "./db/PanneDB.php";
require_once "./db/TypeEquipementDB.php";


class DB {

    public static function configuration(){
        return new ConfigurationDB;
    }

    public static function equipement(){
        return new EquipementDB;
    }

    public static function fichierConfig(){
        return new FichierConfigDB;
    }

    public static function panne(){
        return new PanneDB;
    }

    public static function typeEquipement(){
        return new TypeEquipementDB;
    }
}

function dd($vars){
    //echo json_encode($vars);
    echo "dump <br><br><br>";
    var_dump($vars);
    die();
}