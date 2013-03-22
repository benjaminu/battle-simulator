<?php

require './autoload.php';

use BattleSimulator\BattleSimulator;

if (! defined('STDIN') ) {
    echo "Not Running from CLI\n";
    exit(0);
}

$simulation = new BattleSimulator;
$simulation->execute();
exit(1);