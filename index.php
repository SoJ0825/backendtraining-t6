<?php

/**
 * =============================
 * 請用 1 行，隨便印出 1 個名字
 * =============================
 */
/*
require_once 'vendor/autoload.php';
$faker = Faker\Factory::create();
echo $faker->name();
*/

/**
 * =============================
 * 請用新的 1 行，隨機印出 5 個名字，中間用 `, ` 分開
 * =============================
 */
/*
require_once 'vendor/autoload.php';
$ans = "";
for ($i = 0; $i < 5; $i++) {
    $faker = Faker\Factory::create();
    $name = $faker->name();
    if ($i == 4) {
        $ans .= $name;
    } else {
        $ans .= $name . ", ";
    }
}
echo $ans;
*/

/**
 * =============================
 * 1. 請用新的 1 行
 * 2. 隨機印出 20 個名字，中間用 `, ` 分開
 * =============================
 */
/*
require_once 'vendor/autoload.php';
$ans = "";
for ($i = 0; $i < 20; $i++) {
    $faker = Faker\Factory::create();
    $name = $faker->name();
    if ($i == 19) {
        $ans .= $name;
    } else {
        $ans .= $name . ", ";
    }
}
echo $ans;
*/

/**
 * =============================
 * 1. 請用新的 1 行
 * 2. 利用 fakerphp/faker 隨機印出 50 個名字
 * 3. 每行 10 個名字，中間用 `, ` 分開，且名字間等距印出
 * =============================
 */
/*
require_once 'vendor/autoload.php';
$ans = "";
for ($i = 0; $i < 50; $i++) {
    $faker = Faker\Factory::create();
    $name = $faker->name();
    $add = "";
    for ($x = 0; $x < strlen($name); $x++) {
        if ($name[$x] == " " && $name[$x - 1] != ".") {
            break;
        } else {
            $add .= $name[$x];
        }
    }
    $add = str_pad($add, 16, " ");
    if ($i == 49) {
        $ans .= $add;
    } elseif ($i % 10 == 9) {
        $ans .= $add . ", \n";
    } else {
        $ans .= $add . ", ";
    }
}
echo $ans;
*/

