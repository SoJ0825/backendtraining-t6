<?php

$names = [];
/**
 * =============================
 * 請用 1 行，隨便印出 1 個名字
 * =============================
 */
$name1 = 'Iron Man';
//$name1 = ' Iron Man'; // OK
//$name1 = ' Iron Man'; // Ok
//$name1 = ' Iron Man '; // OK
//$name1 = ''; // fail
//$name1 = ' '; // fail
//$name1 = '  '; //fail
//$name1 = '   '; // fail
//$name1 = '                            '; //fail
array_push($names, $name1);
echo $name1 . PHP_EOL;

/**
 * =============================
 * 請用新的 1 行，隨機印出 5 個名字，中間用 `, ` 分開
 * =============================
 */
$name2 = ['Iron Man', 'Spider Man', 'Thor', 'American Captain', 'Eagle eye'];
$names = array_merge($names, $name2);
$name2Length = count($name2);
echo implode(', ', $name2) . PHP_EOL;

/**
 * =============================
 * 1. 請用新的 1 行
 * 2. 隨機印出 20 個名字，中間用 `, ` 分開
 * =============================
 */
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$name3 = [];
for ($i = 0; $i < 20; $i++) {
    array_push($name3, generateRandomString());
}
$names = array_merge($names, $name3);
echo implode(', ', $name3) . PHP_EOL;

/**
 * =============================
 * 1. 請用新的 1 行
 * 2. 利用 fakerphp/faker 隨機印出 50 個名字
 * 3. 每行 10 個名字，中間用 `, ` 分開，且名字間等距印出
 * =============================
 */

function check($names)
{
    foreach ($names as $name) {
        $oldName = $name;
        $name = trim($name, ' ');
        if (empty($name)) {
            echo '============================' . PHP_EOL;
            echo $oldName . PHP_EOL;
            echo 'check failed';
            die();
        }
    }
    echo PHP_EOL . '----------------------------' . PHP_EOL;
    echo 'check OK';
}

check($names);
