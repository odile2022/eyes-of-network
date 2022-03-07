<?php

class PanneDB extends CrudDB {
   
    public function tableName() {
        return " ridb.ri_panne ";
     }
 
     public function tableColumns() {
        return [
             'nom',
             'description',
             // 'id',
         ];
     }
}