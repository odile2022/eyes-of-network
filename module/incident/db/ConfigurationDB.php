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
            'equipements',
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
            'equipements',
            'cmd',
            // 'id',
         ];
     }
}