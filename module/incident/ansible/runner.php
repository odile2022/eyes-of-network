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
            foreach ($conf['commands'] as $cmd) {
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

function createAndRunAnsiblePlaybook($typeEquip, $fichierConfig, $equipements, $vars)
{
    $baseDir = "/srv/eyesofnetwork/eonweb/temp/ansible_config_".time();
    $varsFilePath = "$baseDir/vars.json";
    $playbookFilePath = "$baseDir/playbook.yml";
    
    if(mkdir ($baseDir)){
        $playbookContent = renderAnsiblePlaybook($typeEquip['template_commandes'], json_decode($fichierConfig['commandes'], true));
        $jsonVars = json_encode($vars);
        file_put_contents($varsFilePath, $jsonVars);
        file_put_contents($playbookFilePath, $playbookContent);

        echo json_encode([$typeEquip, $fichierConfig, $equipements, $vars]);
        die();
    }else{
        echo "Erreur: Echec creation du repertoire: $baseDir";
        die();
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