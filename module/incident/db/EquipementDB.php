<?php

class EquipementDB extends CrudDB {
   
    public function tableName() {
        return " ridb.ri_equipement ";
     }
 
     public function tableColumns() {
        return [
             'adresse_ip',
             'ssh_user',
             'ssh_password',
             'nom',
             'description',
             // 'id',
         ];
     }
 
     public function configTableColumns() {
        return [
             'adresse_ip',
             'nom',
             'description',
             // 'id',
         ];
     }
     

     public function configTableData($id) {
        $stmt = $this->executeQuery("SELECT * FROM ".$this->tableName().";");
        $result =[];
        while ($row = $stmt->fetch()) {
            $result[] = $this->rowToConfigTableData($row);
        }
        return $result;
    }

    protected function rowToConfigTableData($row) {
        $cols = $this->configTableColumns();
        $data = ["<span class='custom-checkbox row_data_input'><input type='hidden' id='row_data_".$row['id']."' name='id' value='".json_encode($this->rowToArray($row))."'><input type='checkbox' name='options[]' value='1'></span>"];
        for ($i=0; $i<count($cols); $i++) {
            $value = $cols[$i];
            $dataVal = strlen($row[$value])>50?(substr($row[$value], 0, 50)."..."):$row[$value];
            $data[] = $dataVal;
        }
        return $data;
    }
}