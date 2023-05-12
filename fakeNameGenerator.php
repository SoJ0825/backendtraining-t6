<?php
/**
 * =============================
 * 請用 1 行，隨便印出 1 個名字
 * =============================
 */
echo "請用 1 行，隨便印出 1 個名字 
=============================\n";
 $names = array(
    'Christopher',
    'Ryan',
    'Ethan',
    'John',
    'Zoey',
    'Sarah',
    'Michelle',
    'Samantha',
);
$random_name = $names[mt_rand(0, sizeof($names) - 1)];
echo $random_name;
echo "\n";
echo "\n";
echo "\n";

/**
 * =============================
 * 請用新的 1 行，隨機印出 5 個名字，中間用 `, ` 分開
 * =============================
 */   
echo "請用新的 1 行，隨機印出 5 個名字，中間用 `, ` 分開 
=============================\n";
 $names = array(
    'Christopher',
    'Ryan',
    'Ethan',
    'John',
    'Zoey',
    'Sarah',
    'Michelle',
    'Samantha',
);
for ($i=0; $i<5; $i++){
    $random_name = $names[mt_rand(0, sizeof($names) - 1)];
    echo $random_name, ", ";
}
echo "\n";
echo "\n";
echo "\n";

/**
 * =============================
 * 1. 請用新的 1 行
 * 2. 隨機印出 20 個名字，中間用 `, ` 分開
 * =============================
 */ 
echo "1. 請用新的 1 行
2. 隨機印出 20 個名字，中間用 `, ` 分開 
=============================\n";
 require_once '../../../vendor/autoload.php';
$faker = Faker\Factory::create();
echo $faker->name();
for ($i=0;$i<20;$i++) {
        echo $faker->name(), ", ";
    }
echo "\n";
echo "\n";
echo "\n";

/**
 * =============================
 * 1. 請用新的 1 行
 * 2. 利用 fakerphp/faker 隨機印出 50 個名字
 * 3. 每行 10 個名字，中間用 `, ` 分開，且名字間等距印出
 * =============================
 */
echo "1. 請用新的 1 行
 2. 利用 fakerphp/faker 隨機印出 50 個名字
 3. 每行 10 個名字，中間用 `, ` 分開，且名字間等距印出 
=============================\n";
require_once '../../../vendor/autoload.php';
$faker = Faker\Factory::create();
// echo $faker->name();
for ($i=0;$i<5;$i++) {
    for ($a=0; $a<10;$a++){
        $name="seventeenth";
        while(strlen($name)>7){
            $name= $faker->firstname();
                }
        // $name1=str_pad($name, 6, ".",STR_PAD_RIGHT);
        $paddedName = str_pad($name, 10, " ",STR_PAD_RIGHT);
        echo $paddedName;
        // $count=$count+1;
        // if ($count<9){
        //     echo ",";
        // }
        if ($a%9!=0){
            echo ",";
        }    
    }
     echo"\n";
    }


