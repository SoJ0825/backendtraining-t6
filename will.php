<?php
require_once 'vendor/autoload.php';
$faker = Faker\Factory::create();
$count = 50;
$name = array();

for ($i=0;$i<$count;$i++){
    $randomString = $faker->name();
    while(in_array($randomString,$name)){
        $randomString = $faker->name();
    }
    array_push($name,$randomString);
}
$max= max(array_map('strlen', $name));
$C_name=$name;
$C_name=array_chunk($C_name,10);

foreach($C_name[0] as $value){
        echo str_pad($value,$max," ") .",";
}
echo PHP_EOL;
foreach($C_name[1] as $value){
    echo str_pad($value,$max," ") .",";
}
echo PHP_EOL;
foreach($C_name[2] as $value){
    echo str_pad($value,$max," ") .",";
}
echo PHP_EOL;
foreach($C_name[3] as $value){
    echo str_pad($value,$max," ") .",";
}
echo PHP_EOL;
foreach($C_name[4] as $value){
    echo str_pad($value,$max," ") .",";
}
