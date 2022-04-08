<?php

class TypeEquipementDB extends CrudDB {
   
    public function tableName() {
        return " ridb.ri_type_equipement ";
    }

    public function tableColumns() {
        return [
            'nom',
            'fabriquant',
            'template_commandes',
            // 'id',
        ];
    }

    public function renderAnsiblePlaybook($id, $tasksConf) {
        $typeEquip = DB::typeEquipement()->find($id);

        if($typeEquip){
            $template_commandes = $typeEquip['template_commandes'];
            $tplContent = explode("tasks" , $template_commandes, 2);

            if(count($tplContent) == 2){
                $tplHeader = $tplContent[0];
                $tplTask = explode(PHP_EOL , $tplContent[1], 2)[1];
                $plabook = "";
                $commandPlaceholder = '${command[]}';
                
                foreach (explode(PHP_EOL , $template_commandes) as $line){
                    if(strpos($line, '${command[]}')){
                        $commandPlaceholder = $line;
                        break;
                    }
                }
        
                foreach ($tasksConf as $conf) {
                    $t = $tplTask;
                    $t = str_replace('${task_name}', $conf['name'], $t);
                    foreach ($conf['commands'] as $cmd) {
                        $commandReplace = str_replace('${command[]}', $cmd, $commandPlaceholder) . PHP_EOL . $commandPlaceholder;
                        $t = str_replace($commandPlaceholder, $commandReplace, $t);
                    }
                    $t = str_replace(PHP_EOL . $commandPlaceholder, '', $t);
                    $plabook .= $t.PHP_EOL;
                }
    
                return $tplHeader."tasks".PHP_EOL.$plabook;
            }

        }
        return null;
    }

}