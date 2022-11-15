<?php

//使用faker產生隨機姓名
require_once 'vendor/autoload.php';
$faker = Faker\Factory::create();
$num =50; //產生多少數量的名字

$randomName = []; //把每個名字變成arra
$max = 0;
for( $i = 0; $i < $num; $i++){
    // 產生隨機姓名為 echo $faker->unique()->name(); ，放入array_push中
    array_push($randomName, $faker->unique()->firstname());
    if (strlen($randomName[$i]) > $max) {
        $max = strlen($randomName[$i]);
    };
};
echo "最長的名字有 $max 位元\n";



//利用迴圈讓每個array元素都一樣長度，變成$result array
$result = []; //用來裝增加空格後的名字
foreach ($randomName as $k => $v) {
    $result[] = str_pad($v, $max, " ");
};



//讓array等距、等數量換行輸出
for($y = 0; $y < ceil($num/10); $y++ ){ //設定$y為輸出row數量
    echo $y."  ";
    echo (implode(", " ,(array_slice($result, $y*10 , 10 , true)))).PHP_EOL;
    //用array_slice分割原本的array變成10個元素一個array，起始點為$result[0]、$result[10]...
};

?>