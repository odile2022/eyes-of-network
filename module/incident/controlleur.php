<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("./../../include/config.php");
require_once("./DB.php");
require_once("./ansible/runner.php");

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
            'type_equipement' => $_POST['type_equipement'],
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
            'type_equipement' => $_POST['type_equipement'],
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
            'type_equipement' => $_POST['type_equipement'],
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
            'type_equipement' => $_POST['type_equipement'],
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
    case 'appliquer_config':
        $id_fichier_config = $_POST['id_fichier_config'];
        $id_equipements = json_decode($_POST['id_equipements']);
        
        if(isset($_POST['vars'])){
            $vars = $_POST['vars'];
        }else{
            $vars = [];
        }
        $fichierConfig = DB::fichierConfig()->find($id_fichier_config);
        $equipements = DB::equipement()->findMany($id_equipements);
        $data = [
            'id_fichier_config' => $id_fichier_config,
            'id_equipements' => $id_equipements,
            'vars' => $vars,
        ];
        if($fichierConfig && $equipements){
            $typeEquip = DB::typeEquipement()->find($fichierConfig['type_equipement']);
            $config = createAndRunAnsiblePlaybook($typeEquip, $fichierConfig, $equipements, $vars);
            //echo json_encode($data);
            echo json_encode($config);
            
            header('Location: /module/incident/configurations_details.php?id=0');
            die();
        }else{
            require_once("./page_erreurs.php'");
            die();
        }
        break;
    default:
        # code...
        break;
}
