<?php
include("../../include/config.php");
require_once("./DB.php");

$taskConfs = [
    [
        'name' => 'Tache 1',
        'commands' => [
            'ls -l .',
            'pwd',
        ]
    ],[
        'name' => 'Tache 2',
        'commands' => [
            'sudo apt install xed',
            'cat /srv/eyesofnetwork/eonweb/index.php',
        ]
    ],
];

/*
$v = DB::typeEquipement()->find(7);

$template_commandes = $v['template_commandes'];
$taskTemplate = explode(PHP_EOL , $template_commandes, 2)[1];
$tasks = [];
$commandPlaceholder = '${command[]}';
foreach (explode(PHP_EOL , $template_commandes) as $line){
    if(strpos($line, '${command[]}')){
        $commandPlaceholder = $line;
        break;
    }
}

foreach ($taskConfs as $conf) {
    $t = $taskTemplate;
    $t = str_replace('${task_name}', $conf['name'], $t);
    foreach ($conf['commands'] as $cmd) {
        $commandReplace = str_replace('${command[]}', $cmd, $commandPlaceholder) . PHP_EOL . $commandPlaceholder;
        $t = str_replace($commandPlaceholder, $commandReplace, $t);
    }
    $t = str_replace(PHP_EOL . $commandPlaceholder, '', $t);
    $tasks[] = $t.PHP_EOL;
}

$out = $tasks[0] .PHP_EOL. $tasks[1];
//*/

echo json_encode(DB::typeEquipement()->renderAnsiblePlaybook(7, $taskConfs));
?>
