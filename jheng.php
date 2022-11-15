<?php
require_once 'vendor/autoload.php';

$faker = Faker\Factory::create();
$names_arr = [];
for ($i = 0; $i < 50; $i++) {
   $names_str = $faker->unique()->firstName();
   //$names_arr  =  array($names_str) ;       // print_r 0 01 012 0123 01234 // echo  連續名字 彼此沒頓號
   $names_arr [] = $names_str; //print_r 0 0 0 0 0 //  echo  頓號進得去,但名字顯示略多

  
}
foreach($names_arr as $key => $value )  {
   if ($key % 10 == 9 && $key!=0) {
    echo str_pad($value, 10) ."\n";
   } else {
      echo str_pad($value, 10).", ";
   }
}
?>