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
}