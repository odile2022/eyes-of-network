<?php

abstract class CrudDB {
   
    public abstract function tableName();
    public abstract function tableColumns();

    public function all() {
        $stmt = $this->executeQuery("SELECT * FROM ".$this->tableName().";");
        $result =[];
        while ($row = $stmt->fetch()) {
            $result[] = $this->rowToArray($row);
        }
        return $result;

    }

    public function find($id) {
        $stmt = $this->executeQuery("SELECT * FROM ".$this->tableName()." where id=?;", $id);
        $row = $stmt->fetch(); 
        if($row){
            return $this->rowToArray($row);
        }else{
            return null;
        }
    }

/*
    public function insert($item) {
        $cols = $this->tableColumns();
        $bind = [];
        $db = $this->getPdo();
        $stmt = $this->executeQuery(
            "INSERT INTO "
                .$this->tableName() ."(`adresse_ip`, `ssh_user`, `ssh_password`, `nom`, `description`) "
                ."VALUES (?, ?, ?, ?, ?);",
            [
                $item['adresse_ip'],
                $item['ssh_user'],
                $item['ssh_password'],
                $item['nom'],
                $item['description'],
            ],
            $db
        );
        $item['id'] = $db->lastInsertId();
        return $item; 
    }

    public function update($item) {
        $db = $this->getPdo();
        $stmt = $this->executeQuery(
            "update `ridb`.`ri_equipement` SET "
                ."`adresse_ip`=?, `ssh_user`=?, `ssh_password`=?, `nom`=?, `description`=? "
                ."WHERE `id`=?;",
            [
                $item['adresse_ip'],
                $item['ssh_user'],
                $item['ssh_password'],
                $item['nom'],
                $item['description'],
                $item['id'],
            ],
            $db
        );
        return $item; 
    }
//*/

    public function delete($id) {
        $this->executeQuery("DELETE FROM ".$this->tableName()." where id=?;", $id);
    }

    protected function executeQuery($sqlQuery, $params=null, $db=null) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        if(!$db){
            $db = $this->getPdo();
        }
        if($params){
            $stmt = $db->prepare($sqlQuery);
            if(!is_array($params)){
                $params = array($params);
            }
            $stmt->execute($params);
            return $stmt;
        }else{
            return $db->query($sqlQuery);
        }
    }

    protected function rowToArray($row) {
        $cols = $this->tableColumns();
        $data = [];
        for ($i=0; $i<count($cols); $i++) {
            $value = $cols[$i];
            $data[$value] = $row[$value];
        }
        return $data;
        return [];
    }

    protected function getPdo() {
        global $database_ri;
		global $database_host;
		global $database_username;
		global $database_password;
        return new PDO('mysql:host='.$database_host.';dbname='.$database_ri, $database_username, $database_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    
}

?>