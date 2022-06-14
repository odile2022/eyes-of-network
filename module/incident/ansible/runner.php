<?php


/**
 * Execute the given command by displaying console output live to the user.
 *  @param  string  cmd          :  command to be executed
 *  @return array   exit_status  :  exit status of the executed command
 *                  output       :  console output of the executed command
 */
function liveExecuteCommand($cmd)
{

    while (@ ob_end_flush()); // end all output buffers if any

    $proc = popen("$cmd 2>&1 ; echo Exit status : $?", 'r');

    $live_output     = "";
    $complete_output = "";

    while (!feof($proc))
    {
        $live_output     = fread($proc, 4096);
        $complete_output = $complete_output . $live_output;
        //echo "$live_output";
        @ flush();
    }

    pclose($proc);

    // get exit status
    preg_match('/[0-9]+$/', $complete_output, $matches);

    // return exit status and intended output
    return array (
                    'exit_status'  => intval($matches[0]),
                    'output'       => str_replace("Exit status : " . $matches[0], '', $complete_output)
                 );
}

function renderAnsiblePlaybook ($template_commandes, $tasksConf) {
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
            $commands = explode(PHP_EOL , $conf['commands']);
            foreach ($commands as $cmd) {
                $commandReplace = str_replace('${command[]}', $cmd, $commandPlaceholder) . PHP_EOL . $commandPlaceholder;
                $t = str_replace($commandPlaceholder, $commandReplace, $t);
            }
            $t = str_replace(PHP_EOL . $commandPlaceholder, '', $t);
            $plabook .= $t.PHP_EOL;
        }

        return $tplHeader."tasks:".PHP_EOL.$plabook;
    }
    return null;
}

function ansibleHostsFromEquipements($equipements){
    $hosts = [];
    $conf = [
        "hosts" => [ "h1" => [ "ansible_host" => "" ] ],
        "vars" => [ "ansible_user" => "", "ansible_ssh_pass" => ""]
    ];
    $i = 0;
    foreach ($equipements as $equip) {
        $hostConf = array_replace_recursive([], $conf);
        $hostConf['hosts'] = [ 
            "h".$i => [ "ansible_host" => $equip['adresse_ip'] ]
        ];
        $hostConf['vars']['ansible_user'] = $equip['ssh_user'];
        $hostConf['vars']['ansible_ssh_pass'] = $equip['ssh_password'];
        $hosts['equip'.$i] = $hostConf;
        $i++;
    }
    return $hosts;
}

function createAndRunAnsiblePlaybook($configurationDB, $ConfigurationEquipementDB, $typeEquip, $fichierConfig, $equipements, $vars)
{
    $baseDir = "/srv/eyesofnetwork/eonweb/temp/ansible_config_".time();
    $varsFilePath = "$baseDir/vars.json";
    $hostsFilePath = "$baseDir/hosts.json";
    $playbookFilePath = "$baseDir/playbook.yml";
    
    if(mkdir ($baseDir)){
        $playbookContent = renderAnsiblePlaybook($typeEquip['template_commandes'], json_decode($fichierConfig['commandes'], true));
        $ansibleHost = ansibleHostsFromEquipements($equipements);
        $jsonVars = json_encode($vars);
        $hostsVars = json_encode($ansibleHost);

        file_put_contents($hostsFilePath, $hostsVars);
        file_put_contents($varsFilePath, $jsonVars);
        file_put_contents($playbookFilePath, $playbookContent);

        $cmd = 'ansible-playbook ' . $playbookFilePath . ' -i '.$hostsFilePath.' --extra-vars "@'.$varsFilePath.'"';
        $config = $configurationDB->insert([
            'cmd' => $cmd,
            'fichier_config' => $fichierConfig['id'],
            'commande_reussie' => 2, // En cours d'execution
            'nom_config' => $fichierConfig['nom'],
            'info' => json_encode([
                'hosts' => $hostsVars,
                'json' => $jsonVars,
                'playbook' => $playbookContent,
            ]),
        ]);
        
        
        foreach ($equipements as $equip) {
            $ConfigurationEquipementDB->insert([
                'id_configuration' => $config['id'],
                'id_equipement' => $equip['id'],
            ]);
        }

        $result = liveExecuteCommand($cmd);

        $config['commande_reussie'] = $result['exit_status']?0:1;
        $config['log_execution'] = $result['output'];
        /* 
        l'execution du playbook est asynchrone,
        la suppression des fichier risque de faire echouer la commande d'execution du playbook
        unlink($hostsFilePath);
        unlink($varsFilePath);
        unlink($playbookFilePath);
        rmdir($baseDir);
        //*/
        $configurationDB->update($config);
        return $config;
    }else{
        return null;
    }
}

function testPlaybookRunner()
{
    $ansibleVars = $_POST['vars'];
    $jsonVars = json_encode($ansibleVars);
    file_put_contents("/srv/eyesofnetwork/eonweb/ansible/test/vars.json", $jsonVars);
    
    $cmd = '/bin/ansible-playbook /srv/eyesofnetwork/eonweb/ansible/test/iosconfig.yml -i /srv/eyesofnetwork/eonweb/ansible/test/hosts --extra-vars "@/srv/eyesofnetwork/eonweb/ansible/test/vars.json"';
    //$cmd = "whoami";
    
    $result = liveExecuteCommand($cmd);
    $out = str_replace("\n", "<br/>", $result);
    echo $cmd;
    echo "<br/>";
    echo json_encode($out);
}


if(isset($_POST['test_playbook'])){
    testPlaybookRunner();
}



//*/

?>