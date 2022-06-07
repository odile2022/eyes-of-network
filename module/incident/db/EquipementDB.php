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
             'type_equipement',
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
        $stmt = $this->executeQuery("SELECT * FROM ".$this->tableName()." WHERE type_equipement = ?;", $id);
        $result =[];
        while ($row = $stmt->fetch()) {
            $result[] = $this->rowToConfigTableData($row);
        }
        return $result;
    }
    public function configDetailTableData($id) {
        $stmt = $this->executeQuery("SELECT id_equipement FROM ri_configuration_equipement WHERE id_configuration = ?;", $id);
        $ids =[];
        while ($row = $stmt->fetch()) {
            $ids[] = $row['id_equipement'];
        }
        $qMarks = str_repeat('?,', count($ids) - 1) . '?';
        $stmt = $this->executeQuery("SELECT * FROM ridb.ri_equipement WHERE  id in ($qMarks);", $ids);
        while ($row = $stmt->fetch()) {
            $result[] = $this->rowToConfigTableDataNoCheck($row);
        }
        return $result;
    }

    public function historiqueTableData() {
        /*$stmt = $this->executeQuery("SELECT * FROM ridb.ri_configuration c, ridb.ri_equipement e, ri_configuration_equipement ce
         WHERE ce.id_equipement = e.id
and ce.id_configuration = c.id order by date desc;");
         $result =[];
         while ($row = $stmt->fetch()) {
             $result[] = $this->rowToConfigTableDataNoCheck($row)($row);
        }
        return $result;//*/
        return [];
    }


    protected function rowToConfigTableData($row) {
        $cols = $this->configTableColumns();
        $data = ["<span class='custom-checkbox row_data_input'><input type='hidden' id='row_data_".$row['id']."' value='".$row['id']."'><input type='checkbox' value='1'></span>"];
        for ($i=0; $i<count($cols); $i++) {
            $value = $cols[$i];
            $dataVal = strlen($row[$value])>50?(substr($row[$value], 0, 50)."..."):$row[$value];
            $data[] = $dataVal;
        }
        return $data;
    }
    
    protected function rowToConfigTableDataNoCheck($row) {
        $cols = $this->configTableColumns();
        for ($i=0; $i<count($cols); $i++) {
            $value = $cols[$i];
            $dataVal = strlen($row[$value])>50?(substr($row[$value], 0, 50)."..."):$row[$value];
            $data[] = $dataVal;
        }
        return $data;
    }
}