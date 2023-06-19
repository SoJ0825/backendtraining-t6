<?php
/**
 * =============================
 * 請用 1 行，隨便印出 1 個名字
 * =============================
 */
/*echo "patrick" ;

/**
 * =============================
 * 請用新的 1 行，隨機印出 5 個名字，中間用 `, ` 分開
 * =============================
 */
/*$name = ["Alice", "Patrick", "Will", "Wade", "Mia"];
echo implode(", ", array_rand(array_flip($name), 5));


/**
 * =============================
 * 1. 請用新的 1 行
 * 2. 隨機印出 20 個名字，中間用 `, ` 分開
 * =============================
 */
/*require_once 'vendor/autoload.php';
$faker = Faker\Factory::create();
$name = array() ;
 for ($i = 0; $i < 21; $i++) {
    $name []  = $faker->name($i);
}
echo implode(", " , $name);

/**
 * =============================
 * 1. 請用新的 1 行
 * 2. 利用 fakerphp/faker 隨機印出 50 個名字
 * 3. 每行 10 個名字，中間用 `, ` 分開，且名字間等距印出
 * =============================
 */
require_once 'vendor/autoload.php';
$ans = "";
for ($i = 1; $i < 51; $i++){
    $faker = Faker\Factory::create();
    $name = $faker -> name();
    $add = "";
    for($x = 0; $x < 30; $x++){
        if(strlen($name) <= $x){
            $add .= " ";
        }
        else{
            $add .= $name[$x];
        }
    }
    $add .= ", ";
    $ans .= $add;
    if($i % 10 == 0){
        $ans .= "\n";
    }
}
echo $ans;
?>