<?php

class TypeEquipementDB extends CrudDB {
   
    public function tableName() {
        return " ridb.ri_type_equipement ";
     }
 
     public function tableColumns() {
        return [
             'nom',
             'chemin_fichier',
             // 'id',
         ];
     }

}