<?php

class ConfigurationDB extends CrudDB {
   
    public function tableName() {
        return " ridb.ri_configuration ";
     }
 
     public function tableColumns() {
        return [
            'nom_config',
            'date',
            'log_execution',
            'commande_reussie',
            'info',
            // 'id',
         ];
     }
 
     public function getUpdateColumns() {
        return [
             'log_execution',
             'commande_reussie',
             // 'id',
         ];
     }
 
     public function getInsertColumns() {
        return [
            'nom_config',
            'fichier_config',
            'info',
            'cmd',
            // 'id',
         ];
     }
     protected function rowToTableData($row) {
        $cols = $this->tableColumns();
        $data = ["<span class='custom-checkbox row_data_input'><input type='hidden' id='row_data_".$row['id']."' name='id' value='".json_encode($this->rowToArray($row))."'><input type='checkbox' name='options[]' value='1'></span>"];
        for ($i=0; $i<count($cols); $i++) {
            $value = $cols[$i];
            $dataVal = strlen($row[$value])>50?(substr($row[$value], 0, 50)."..."):$row[$value];
            $data[] = $dataVal;
        }
        $data[] = "<i onclick='editItem(this, ".$row['id'].");' class='edit material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i>"
        ."<i onclick='deleteItem(this, ".$row['id'].");' class='delete material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i>";
        $data[1] = "<a href='configurations_details.php?id=".$row['id']."'>" . $data[1] ."</a>";
        return $data;
    }
}