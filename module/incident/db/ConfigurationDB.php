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
 
     public function getUpdateColumns() {
        return [
             //'log_execution',
             'commentaire',
             // 'id',
         ];
     }
 
     public function getInsertColumns() {
        return [
             'log_execution',
             'commentaire',
             // 'id',
         ];
     }
}