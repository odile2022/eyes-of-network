<?php

class ConfigurationEquipementDB extends CrudDB {
   
    public function tableName() {
        return " ridb.ri_configuration_equipement ";
     }
 
     public function tableColumns() {
        return [
            'id_configuration',
            'id_equipement',
            // 'id',
         ];
     }
 
     public function getUpdateColumns() {
        return [
             'id_configuration',
             'id_equipement',
             // 'id',
         ];
     }
 
     public function getInsertColumns() {
        return [
            'id_configuration',
            'id_equipement',
            // 'id',
         ];
     }
     
}