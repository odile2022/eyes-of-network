<?php

class FichierConfigDB extends CrudDB {
   
    public function tableName() {
        return " ridb.ri_fichier_config ";
     }
 
     public function tableColumns() {
        return [
             'nom',
             'commandes',
             'variables',
             'type_equipement',
             // 'id',
         ];
     }


    public function tableData() {
        $stmt = $this->executeQuery("SELECT c.*, t.nom nom_equipement FROM ridb.ri_fichier_config c join ridb.ri_type_equipement t on c.type_equipement = t.id;");
        $result =[];
        while ($row = $stmt->fetch()) {
            $result[] = $this->rowToTableData($row);
        }
        return $result;
    }

     protected function rowToTableData($row) {
        $cols = [
            'nom',
            'commandes',
            'variables',
            'nom_equipement',
            'type_equipement',
            // 'id',
        ];
        $data = ["<span class='custom-checkbox row_data_input'><input type='hidden' id='row_data_".$row['id']."' name='id' value='".json_encode($this->rowToArray($row))."'><input type='checkbox' name='options[]' value='1'></span>"];
        for ($i=0; $i<count($cols)-1; $i++) {
            $value = $cols[$i];
            $dataVal = strlen($row[$value])>50?(substr($row[$value], 0, 50)."..."):$row[$value];
            $data[] = $dataVal;
        }
        $data[] = "<i onclick='editItem(this, ".$row['id'].");' class='edit material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i>"
        ."<i onclick='deleteItem(this, ".$row['id'].");' class='delete material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i>";
        $data[1] = "<a href='appliquer_config.php?id=".$row['id']."'>" . $data[1] ."</a>";
        return $data;
    }
}