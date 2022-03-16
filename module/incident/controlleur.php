<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("./../../include/config.php");
require_once("./DB.php");

$action=$_GET['action'];
switch ($action) {
    case 'save_type_equipement':
        $data = [
            'nom'=>$_POST['nom'],
            'chemin_fichier'=>$_POST['chemin_fichier'],
        ];
        //var_dump($data);
        //exit();
        DB::typeEquipement()->insert($data);
        header('Location: /module/incident/groupes_equipements.php');
        die();
        break;
    case 'edit_type_equipement':
        $data = [
            'id'=>$_POST['id'],
            'nom'=>$_POST['nom'],
            'chemin_fichier'=>$_POST['chemin_fichier'],
        ];
        DB::typeEquipement()->update($data);
        header('Location: /module/incident/groupes_equipements.php');
        die();
        break;
    case 'delete_type_equipement':
        $ids = $_POST['id'];
        foreach ($ids as $id) {
            DB::typeEquipement() ->delete($id);
        }
        header('Location: /module/incident/groupes_equipements.php');
        die();
        break;
    default:
        # code...
        break;
}