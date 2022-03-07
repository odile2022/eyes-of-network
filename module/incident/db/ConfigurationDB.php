<?php

class ConfigurationDB extends CrudDB {
   
    public function tableName() {
        return " ridb.ri_configuration ";
     }
 
     public function tableColumns() {
        return [
             'date',
             'log_execution',
             'commentaire',
             // 'id',
         ];
     }
}