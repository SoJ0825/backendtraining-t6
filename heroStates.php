<?php
$hero = [
    'name'         => 'soj',
    'HP'           => 100,
    'maxHP'        => 100,
    'MP'           => 100,
    'maxMP'        => 100,
    'attack'       => 1,
    'defense'      => 2,
    'magicAttack'  => 3,
    'magicDefense' => 4,
];
printStates($hero, 'initial states', true);
do {
    sleep(1);
    $decreaseHP = random_int(5, 10);
    $hero['HP'] -= $decreaseHP;
    if ($hero['HP'] < 0) $hero['HP'] = 0;
    printStates($hero, "-$decreaseHP HP");
} while ($hero['HP'] > 0);

function printStates($hero, $event = '', $init = false)
{
    $currentHP = pad($hero['HP']);
    $currentMP = pad($hero['MP']);
    $maxHP = pad($hero['maxHP']);
    $maxMP = pad($hero['maxMP']);
    $attack = pad($hero['attack']);
    $defense = pad($hero['defense']);
    $magicAttack = pad($hero['magicAttack']);
    $magicDefense = pad($hero['magicDefense']);
    if (!empty($event)) {
        $states[] = "event: $event";
    }
    if (!$init) {
        echo chr(27) . "[0G";
        echo chr(27) . "[7A";
    }
    $states[] = "name:" . $hero['name'];
    $states[] = "HP:$currentHP/$maxHP";
    $states[] = "MP:$currentMP/$maxMP";
    $states[] = "attack:$attack";
    $states[] = "defense:$defense";
    $states[] = "magicAttack:$magicAttack";
    $states[] = "magicDefense:$magicDefense";
    echo implode('|' . PHP_EOL, typesetting($states, 30));
}

function pad($string, $length = 4, $padString = ' ', $strPAD = STR_PAD_LEFT)
{
    return str_pad($string, $length, $padString, $strPAD);
}

function typesetting($states, $maxLength)
{
    foreach ($states as $index => $state) {
        $states[$index] = pad($state, $maxLength, ' ', STR_PAD_RIGHT);
    }
    return $states;
}
