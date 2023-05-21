<?php
#create a hero staus
$hp = 100;
$name = 'wade';
$mp = 1000;

while($hp > 0){
    $random_num = mt_rand(-10, 0);
    $array=["event: ". $random_num. " HP", "name:". $name, "HP:". $hp. "/100", "MP:". $mp];
    echo implode("\n", $array);
    sleep(2);
    system('clear');
    $hp = $hp + $random_num;
    }

echo "Game over! \n";
