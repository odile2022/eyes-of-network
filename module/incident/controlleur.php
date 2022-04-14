<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("./../../include/config.php");
require_once("./DB.php");

$action = $_GET['action'];
switch ($action) {
    case 'save_type_equipement':
        $data = [
            'nom' => $_POST['nom'],
            'fabriquant' => $_POST['fabriquant'],
            'template_commandes' => $_POST['template_commandes'],
        ];
        //var_dump($data);
        //exit();
        DB::typeEquipement()->insert($data);
        header('Location: /module/incident/groupes_equipements.php');
        die();
        break;
    case 'edit_type_equipement':
        $data = [
            'id' => $_POST['id'],
            'nom' => $_POST['nom'],
            'fabriquant' => $_POST['fabriquant'],
            'template_commandes' => $_POST['template_commandes'],
        ];
        DB::typeEquipement()->update($data);
        header('Location: /module/incident/groupes_equipements.php');
        die();
        break;
    case 'delete_type_equipement':
        $ids = $_POST['id'];
        foreach ($ids as $id) {
            DB::typeEquipement()->delete($id);
        }
        header('Location: /module/incident/groupes_equipements.php');
        die();
        break;
    case 'save_fichier_configuration':
        $data = [
            'nom' => $_POST['nom'],
            'commandes' => $_POST['commandes'],
            'variables' => $_POST['variables'],
        ];
        //var_dump($data);
        //exit();
        DB::fichierConfig()->insert($data);
        header('Location: /module/incident/fichiers_config.php');
        die();
        break;
    case 'edit_fichier_configuration':
        $data = [
            'id' => $_POST['id'],
            'nom' => $_POST['nom'],
            'commandes' => $_POST['commandes'],
            'variables' => $_POST['variables'],
        ];
        DB::fichierConfig()->update($data);
        header('Location: /module/incident/fichiers_config.php');
        die();
        break;
    case 'delete_fichier_configuration':
        $ids = $_POST['id'];
        foreach ($ids as $id) {
            DB::fichierConfig()->delete($id);
        }
        header('Location: /module/incident/fichiers_config.php');
        die();
        break;
    case 'save_equipement':
        $data = [
            'adresse_ip' => $_POST['adresse_ip'],
            'ssh_user' => $_POST['ssh_user'],
            'ssh_password' => $_POST['ssh_password'],
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
        ];
        //var_dump($data);
        //exit();
        DB::equipement()->insert($data);
        header('Location: /module/incident/equipements.php');
        die();
        break;
    case 'edit_equipement':
        $data = [
            'id' => $_POST['id'],
            'adresse_ip' => $_POST['adresse_ip'],
            'ssh_user' => $_POST['ssh_user'],
            'ssh_password' => $_POST['ssh_password'],
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
        ];
        DB::equipement()->update($data);
        header('Location: /module/incident/equipements.php');
        die();
        break;
    case 'delete_equipement':
        $ids = $_POST['id'];
        foreach ($ids as $id) {
            DB::equipement()->delete($id);
        }
        header('Location: /module/incident/equipements.php');
        die();
        break;
    case 'save_panne':
        $data = [
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
        ];
        //var_dump($data);
        //exit();
        DB::panne()->insert($data);
        header('Location: /module/incident/pannes.php');
        die();
        break;
    case 'edit_panne':
        $data = [
            'id' => $_POST['id'],
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
        ];
        DB::panne()->update($data);
        header('Location: /module/incident/pannes.php');
        die();
        break;
    case 'delete_panne':
        $ids = $_POST['id'];
        foreach ($ids as $id) {
            DB::panne()->delete($id);
        }
        header('Location: /module/incident/pannes.php');
        die();
        break;
    case 'save_configuration':
        $data = [
            'log_execution' => $_POST['log_execution'],
            'commentaire' => $_POST['commentaire'],
        ];
        //var_dump($data);
        //exit();
        DB::configuration()->insert($data);
        header('Location: /module/incident/configurations.php');
        die();
        break;
    case 'edit_configuration':
        $data = [
            'id' => $_POST['id'],
            //'log_execution' => $_POST['log_execution'],
            'commentaire' => $_POST['commentaire'],
        ];
        DB::configuration()->update($data);
        header('Location: /module/incident/configurations.php');
        die();
        break;
    case 'delete_configuration':
        $ids = $_POST['id'];
        foreach ($ids as $id) {
            DB::configuration()->delete($id);
        }
        header('Location: /module/incident/configurations.php');
        die();
        break;
    default:
        # code...
        break;
}
