<?php

require_once 'Player.php';
require_once 'Slime.php';
require_once 'PlayGround.php';

$player = new Player('soj');
$slime = new Slime('slime001');
$playGround = new PlayGround($player, $slime);
$playGround->print();
$serialNumber = 1;
do {
    $playGround->fight();
    sleep(1);
    if ($slime->isDead()) {
        $serialNumber += 1;
        $slime = new Slime('slime' . str_pad($serialNumber, 3, '0', STR_PAD_LEFT));
        $playGround->setEnemy($slime);
    }
} while (!$player->isDead());
