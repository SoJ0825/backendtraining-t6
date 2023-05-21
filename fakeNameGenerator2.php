<?php
#create name<7
class Faker{
    public $name;
    public $strNum;
    public $faker;
    public $strLen;

    function __construct($strLen){
        require_once '../../../vendor/autoload.php';
        $this->faker=Faker\Factory::create();
        $this->strLen=$strLen;
    }

    function createName(){
        $this->name= "Very long name that you can't image";
        while(strlen($this->name)!=$this->strLen){
            $this->name= $this->faker->firstname();
        }
    }

#create space
    function createBlank(){
        $name=$this->name;
        $blank=10-strlen($name);
        for($b=0;$b<$blank;$b++){
            $name=$name." ";
        }
        $this->name=$name;
    }

#print
    function printName($strNum){
        $array=[];
        for($i=0;$i<$strNum;$i++){
            $this->createName();
            $this->createBlank();
            array_push($array,$this->name);  
        }
        sort($array);
        $count=0;
        $count1=0;
        foreach($array as $row){
            echo $row;
            $count=$count+1;
            $count1=$count1+1;
            #add comma
            if($count1<$strNum && $count<10){
                echo ",";
            }
            #change line
            if($count==10){
                echo "\n";
                $count=0;
            }
        }
}
}
// }
$inputstrnum=readline("Please enter a num of the name which you want to create.");
$inputstrlen=readline("Please enter the strength of the name which you want to create.");
$faker= new Faker($inputstrlen);
$faker->printName($inputstrnum);
