<?php
// Parent classes
class Character {
    protected $hp;
    protected $mp;
    protected $name;
    protected $attack;
    protected $defense;
    protected $magicAttack;
    protected $magicDefense;
    protected $speed;
    protected $progressBar;

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

    public function getHP() {
        return $this->hp;
    }

    public function getSpeed() {
        return $this->speed;
    }

    public function getProgressBar() {
        return strlen($this->progressBar);
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
}

trait heroAttack {
    public function physicalAttack(Character $character){
        $character->beAttacked($this->attack);
        }
        
    public function fireBall(Character $character){
            $character->beFired($this->magicAttack);
        }
        
    public function iceBall(Character $character){    
        $character->beIced($this->magicAttack);
        }
}

interface Monsters{
    public function normolAttack();
    public function strongAttack();

    }
    
    // Child classes
class Hero extends Character {
    protected $attackJudgment;

    public function attackRenew(){
        $this->attackJudgment = 0;
    }

    use heroAttack;
    public function attackJuge(Character $character){
        $this->attackJudgment = mt_rand(0, 2);
        if($this->attackJudgment == 1){
            $this->fireBall($character);
            // $this->attackJudgment = 0; 
            }elseif($this->attackJudgment == 2){
                $this->iceBall($character);
                // $this->attackJudgment = 0;
                }else{
                    $this->physicalAttack($character);
                }
    }

    public function echoAtttack(){
        if($this->attackJudgment == 1){
            echo "Fire ball!";
            $this->attackRenew();
        }elseif($this->attackJudgment == 2){
            echo "Ice ball!";
            $this->attackRenew();
        }
    }

}

class Monster extends Character {
    public function attack(Character $character){
        $character->beAttacked($this->attack);
    }

    public function beFired($magicAttack) {
        $this->hp = $this->hp - ($magicAttack + 10 - $this->magicDefense);
    }

    public function beIced($magicAttack) {
        $this->hp = $this->hp - ($magicAttack + 15 - $this->magicDefense);
    }
}


class battleScene {
    protected $character1;
    protected $character2;
    protected $heroStatus;
    protected $monsterStatus;
    
    public function __construct($character1, $character2){
        $this->character1 = $character1;
        $this->character2 = $character2;
    }

    public function startBattle(){
        while($this->character1->getHP() > 0){
            #Renew the status;
            $this->printStatus();
            $this->character1->echoAtttack();
            $this->renewScene();
            $this->move();
            $this->moveJudgement();
            $this->renewMonster();  
            }
    }

    public function printStatus(){
        for($i = 0; $i < 9; $i ++){
            $commomProperty = array_merge($this->character1->statusReturn(), $this->character2->statusReturn());
            $b = [str_pad($commomProperty[$i], 30, " ",STR_PAD_RIGHT), str_pad($commomProperty[$i+9], 30, " ",STR_PAD_LEFT)];
            echo implode("|", $b);
            echo "\n";
        }
     
    }
    
    public function renewScene(){
        sleep(2);
        system('clear');
    }

    public function move(){
        $this->character1->progressBar();
        $this->character2->progressBar();
    }

    public function moveJudgement(){
        if($this->character1->getProgressBar() == 0){ 
            $this->character1->attackJuge($this->character2);
        }
        if($this->character2->getProgressBar() == 0){   
            $this->character2->attack($this->character1);
        }
    }

    public function renewMonster(){
        if($this->character2->getHP() <= 0){
            require_once '../../../../vendor/autoload.php';
            $faker = Faker\Factory::create();
            $property = mt_rand(0, 50);
            $this->character2 = new Monster($faker->firstname(), 100, 90, $property, $property, 5,$property ,$property);
            $this->character2->progressBarRenew();
        }
    }
}
  
#create the object;
$hero = new Hero("wade", 100, 100, 50, 10, 8, 50, 10);
// $hero->heal();
$monster = new Monster("YouKnowWho", 100, 90, 20, 40, 6, 10, 20);
$heroStatus = $hero->statusReturn();
$monsterStatus = $monster->statusReturn();
$battleScene = new battleScene($hero, $monster);
$battleScene->startBattle();












