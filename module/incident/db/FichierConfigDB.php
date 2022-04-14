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
             // 'id',
         ];
     }
}