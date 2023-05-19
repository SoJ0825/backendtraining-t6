<?php
// Parent classes
abstract class character {
    protected $hp;
    protected $mp;
    protected $name;
    protected $attack;
    protected $defense;
    protected $magicAttack;
    protected $magicDefense;
    protected $speed;
    protected $progressBar;
    protected $magicAttackJudgment;

    public function __construct($name, $hp, $mp, $attack, $defense, $speed, $magicAttack, $magicDefense) {
        $this->name = $name;
        $this->hp = $hp;
        $this->mp = $mp;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->speed = $speed;
        $this->magicAttack = $magicAttack;
        $this->magicDefense = $magicDefense;
        $this->progressBar = "";
    }
    public function statusReturn(){
        return[
            "name: " . $this->name,
            "HP: " . $this->hp,
            "MP: " . $this->mp,
            "attack: " . $this->attack,
            "defense: " . $this->defense,
            "speed: " . $this->speed,
            "magicAttack: " . $this->magicAttack,
            "magicDefense: " . $this->magicDefense,
            $this->progressBar
        ];
    }

    public function progressBar() {
        $this->progressBar = $this->progressBar . str_repeat("=", $this->speed);
        if (strlen($this->progressBar) >= 30){
        $this->progressBarRenew();
        }
    }

    public function progressBarRenew() {
        $this->progressBar = "";
    }
       
    public function beAttacked($attack) {
        if(($attack - $this->defense) >= 0){
            $this->hp = $this->hp - ($attack - $this->defense) ;
        }
    }

    public function beMagicAttacked($magicAttack) {
        $this->hp = $this->hp - ($magicAttack - $this->magicDefense);
    }
    abstract public function attack(Character $character);

}

    // Child classes
class Hero extends Character {
    public function attack(Character $character){
        $randomNum = mt_rand(0, 1);
        if($randomNum == 1){
            $character->beMagicAttacked($this->magicAttack);
            $this->magicAttackJudgment = $this->magicAttackJudgment + 1;
        }else{
            $character->beAttacked($this->attack);
        }
    }
};

class Monster extends Character {
    public function attack(Character $character){
        $character->beAttacked($this->attack);
    }
}

class battleScene extends Character{
    protected $character1;
    protected $character2;
    protected $heroStatus;
    protected $monsterStatus;
    protected $heroTime;
    protected $monsterTime;

    public function __construct($character1, $character2, $heroStatus, $monsterStatus, $heroTime, $monsterTime){
        $this->character1 = $character1;
        $this->character2 = $character2;
        $this->heroStatus = $heroStatus;
        $this->monsterStatus = $monsterStatus;
        $this->heroTime = $heroTime;
        $this->monsterTime = $monsterTime;
    }

    public function startBattle(){
        while($this->character1->hp > 0){
            #Renew the status;
            $this->printStatus();
            $this->renewStatus();
            $this->renewScene();
            $this->move();
            $this->attackjudgement();
            $this->renewMonster();
                #print status    
            }
    }

    public function printStatus(){
        for($i = 0; $i < 9; $i ++){
            $commomProperty = array_merge($this->heroStatus, $this->monsterStatus);
            $b = [str_pad($commomProperty[$i], 30, " ",STR_PAD_RIGHT), str_pad($commomProperty[$i+9], 30, " ",STR_PAD_LEFT)];
            echo implode("|", $b);
            echo "\n";
        }
        #printMagicAttack
        if($this->character1->magicAttackJudgment > 0){
            echo "magic attack!";
            $this->character1->magicAttackJudgment = 0;
        }
    }
    
    public function renewStatus(){
        $this->heroStatus = $this->character1->statusReturn();
        $this->monsterStatus = $this->character2->statusReturn();
    }

    public function renewScene(){
        sleep(2);
        system('clear');
    }

    public function move(){
        $this->character1->progressBar();
        $this->character2->progressBar();
    }

    public function attackjudgement(){
        $this->heroTime = $this->heroTime + $this->character1->speed;
        $this->monsterTime = $this->monsterTime + $this->character2->speed;
        if($this->heroTime >= 30){
            $this->character1->attack($this->character2);
            $this->heroTime = 0;
        }
        if($this->monsterTime >= 30){
            $this->character2->attack($this->character1);
            $this->monsterTime = 0;
        }
    }

    public function renewMonster(){
        if($this->character2->hp <= 0){
            require_once '../../../../vendor/autoload.php';
            // require_once '/Home/vendor/autoload.php';
            $faker = Faker\Factory::create();
            $property = mt_rand(0, 50);
            $this->character2 = new Monster($faker->firstname(), 100, 90, $property, $property, 5,$property ,$property);
            $this->character2->progressBarRenew();
        }
    }
    public function attack(Character $character){
    }
}
  
#create the object;
$hero = new Hero("wade", 100, 100, 50, 10, 8, 50, 10);
// $hero->heal();
$monster = new Monster("YouKnowWho", 100, 90, 20, 40, 6, 10, 20);
$heroStatus = $hero->statusReturn();
$monsterStatus = $monster->statusReturn();
$heroTime = 0;
$monsterTime = 0;
$battleScene = new battleScene($hero, $monster, $heroStatus, $monsterStatus, $heroTime, $monsterTime);
$battleScene->startBattle();
