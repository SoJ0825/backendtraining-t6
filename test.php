<?php
class animal{
    function eat(){
        echo '我要吃';
    }
}

class dog extends animal{
        private $eat;
    function eat(){
        $eat = parent::eat();
        echo $eat.'肉';
    }
}

$dog = new dog();
$dog->eat();
