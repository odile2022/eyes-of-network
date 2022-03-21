<?php


abstract class CrudDB {
   
    public abstract function tableName();
    public abstract function tableColumns();

    public function tableData() {
        $stmt = $this->executeQuery("SELECT * FROM ".$this->tableName().";");
        $result =[];
        while ($row = $stmt->fetch()) {
            $result[] = $this->rowToTableData($row);
        }
        return $result;
    }

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

    public function insert($item) {
        $db = $this->getPdo();
        $this->executeQuery(
            "INSERT INTO "
                .$this->tableName() ."(".$this->insertAssociationList().") "
                ."VALUES (".$this->valuesPlaceholderList().");",
                $this->valuesFromItem($this->getInsertColumns(), $item, false),
            $db
        );
        $item['id'] = $db->lastInsertId();
        return $item; 
    }

    public function update($item) {
        $db = $this->getPdo();
        $stmt = $this->executeQuery(
            "update ".$this->tableName()." SET "
                .$this->updateColumnsList()
                . "WHERE `id`=?;",
            $this->valuesFromItem($this->getUpdateColumns(), $item, true),
            $db
        );
        return $item; 
    }

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
        $data['id'] = $row['id'];
        return $data;
    }

    protected function rowToTableData($row) {
        $cols = $this->tableColumns();
        $data = ["<span class='custom-checkbox row_data_input'><input type='hidden' id='row_data_".$row['id']."' name='id' value='".json_encode($this->rowToArray($row))."'><input type='checkbox' name='options[]' value='1'></span>"];
        for ($i=0; $i<count($cols); $i++) {
            $value = $cols[$i];
            $dataVal = strlen($row[$value])>50?(substr($row[$value], 0, 50)."..."):$row[$value];
            $data[] = $dataVal;
        }
        //$data[] = "<a href='#editEmployeeModal' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>"
        //            ."<a href='#deleteEmployeeModal' class='delete' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>";
        $data[] = "<i onclick='editItem(this, ".$row['id'].");' class='edit material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i>"
        ."<i onclick='deleteItem(this, ".$row['id'].");' class='delete material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i>";
        return $data;
    }

    protected function valuesFromItem($cols, $item, $withId) {
        $data = [];
        for ($i=0; $i<count($cols); $i++) {
            $col = $cols[$i];
            $data[] = $item[$col];
        }
        if($withId){
            $data[] = $item['id'];
        }
        return $data;
    }

    protected function insertAssociationList(){
        $cols = $this->getInsertColumns();
        $str = "`".$cols[0]."`";
        for($i=1; $i<count($cols); $i++){
            $str .= ", `".$cols[$i]."`";
        }
        return $str;
    }

    protected function valuesPlaceholderList(){
        $cols = $this->getInsertColumns();
        $str = "?";
        for($i=1; $i<count($cols); $i++){
            $str .= ", ?";
        }
        return $str;
    }

    protected function updateColumnsList(){
        $cols = $this->getUpdateColumns();
        $str = "`".$cols[0]."`=?";
        for($i=1; $i<count($cols); $i++){
            $str .= ", `".$cols[$i]."`=?";
        }
        return $str;
    }

    protected function getPdo() {
        global $database_ri;
		global $database_host;
		global $database_username;
		global $database_password;
        return new PDO('mysql:host='.$database_host.';dbname='.$database_ri, $database_username, $database_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    
    protected function getUpdateColumns(){
        return $this->tableColumns();
    }
    
    protected function getInsertColumns(){
        return $this->tableColumns();
    }
    
}

?>