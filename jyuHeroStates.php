<?php
class Hero
{
    public $name;
    public $healthPoint;
    public $attack;
    public $defense;
    public $magicAttack;
    public $magicDefense;
    public $selfHeal;
    public $speed;
    public $possToMagicAttack;

    public function __construct($name)
    {
        $this->name = $name;
    }
    public function attack(Hero $enemy)
    {
        $enemy->healthPoint -= ($this->attack - $enemy->defense);
    }
    public function magicAttack(Hero $enemy)
    {
        $enemy->healthPoint -= ($this->magicAttack - $enemy->magicDefense);
    }
}

function replaceCommandOutput(array $output)
{
    static $oldLines = 0;
    $numNewLines = count($output);

    if ($oldLines == 0) {
        $oldLines = $numNewLines;
    }

    echo implode(" " . PHP_EOL, $output);
    echo PHP_EOL;
    //echo chr(27) . "[0G";
    //echo chr(27) . "[" . $oldLines . "A";

    $numNewLines = $oldLines;
}

function printCompetitionState(Hero $player, Hero $enemy, $state)
{
    printf("%s", $state);
    echo PHP_EOL;
    printf("Name        : %-10s||%10s", $player->name, $enemy->name);
    echo PHP_EOL;
    printf("HP          : %-10s||%10s", $player->healthPoint, $enemy->healthPoint);
    echo PHP_EOL;
    printf("物理攻擊      :%-10s||%10s", $player->attack, $enemy->attack);
    echo PHP_EOL;
    printf("防禦         : %-10s||%10s", $player->defense, $enemy->defense);
    echo PHP_EOL;
    printf("魔法攻擊      : %-10s||%10s", $player->magicAttack, $enemy->magicAttack);
    echo PHP_EOL;
    printf("魔法防禦      : %-10s||%10s", $player->defense, $enemy->defense);
    echo PHP_EOL;
    printf("戰後恢復      : %-10s||%10s", $player->selfHeal, $enemy->selfHeal);
    echo PHP_EOL;
    printf("速度         : %-10s||%10s", $player->speed, $enemy->speed);
    echo PHP_EOL;
    printf("魔攻機率      : %-10s||%10s", $player->possToMagicAttack, $enemy->possToMagicAttack);
    echo PHP_EOL;
    
    echo PHP_EOL;
    echo PHP_EOL;
    echo chr(27) . "[0G";
    echo chr(27) . "[" . 12 . "A";
    //echo chr(27) . "[0G";

}
function selectOccupation()
{
    $flag = 0;
    while (!$flag) {
        echo "以下是四位勇者的特性：" . PHP_EOL;
        echo "0. 杖之勇者：魔攻和進行魔攻的機率最高。" . PHP_EOL;
        echo "1. 劍之勇者：數值平均，物攻略高。" . PHP_EOL;
        echo "2. 盾之勇者：防禦最高。" . PHP_EOL;
        echo "3. 凳之勇者：數值平均，速度最快。" . PHP_EOL;
        echo "現在，請選擇你要當哪名勇者（輸入數字）：";
        $occupation = fread(STDIN, 4);
        if ($occupation == 0) {
            echo "親愛的杖之勇者，";
            $flag = 1;
        } elseif ($occupation == 1) {
            echo "親愛的劍之勇者，";
            $flag = 1;
        } elseif ($occupation == 2) {
            echo "親愛的盾之勇者，";
            $flag = 1;
        } elseif ($occupation == 3) {
            echo "親愛的凳之勇者，";
            $flag = 1;
        } else {
            echo "輸入錯誤，請重新選擇職業。" . PHP_EOL;
            sleep(1);
        }
    }
    return $occupation;
}
function assignHeroValue(Hero $player, $occupation)
{
    if ($occupation == 0) {
        //1. 杖之勇者：魔攻和進行魔攻的機率最高。
        $player->healthPoint = rand(90, 95);
        $player->attack = rand(3, 4);
        $player->defense = rand(0, 1);
        $player->magicAttack = rand(12, 15);
        $player->magicDefense = rand(0, 1);
        $player->selfHeal = rand(50, 60);
        $player->speed = rand(10, 20);
        $player->possToMagicAttack = rand(50, 55);

    } elseif ($occupation == 1) {
        //2. 劍之勇者：數值平均，物攻略高。
        $player->healthPoint = rand(92, 96);
        $player->attack = rand(6, 7);
        $player->defense = rand(2,3);
        $player->magicAttack = 0;
        $player->magicDefense = rand(1, 2);
        $player->selfHeal = rand(55, 60);
        $player->speed = rand(15, 30);
        $player->possToMagicAttack = 0;
    } elseif ($occupation == 2) {
        //3. 盾之勇者：防禦最高。
        $player->healthPoint = rand(115, 120);
        $player->attack = rand(4, 5);
        $player->defense = rand(3,4);
        $player->magicAttack = rand(6, 7);
        $player->magicDefense = rand(3, 4);
        $player->selfHeal = rand(60, 65);
        $player->speed = rand(0, 20);
        $player->possToMagicAttack = rand(0, 10);
    } elseif ($occupation == 3) {
        //4. 凳之勇者：刺客類型，爆發性傷害，必定先攻。
        $player->healthPoint = rand(95, 100);
        $player->attack = rand(8, 10);
        $player->defense = rand(1, 2);
        $player->magicAttack = rand(1, 2);
        $player->magicDefense = rand(1, 2);
        $player->selfHeal = rand(75, 80);
        $player->speed = rand(80, 100);
        $player->possToMagicAttack = rand(30, 35);
    }

}

function chooseRandomEnemy($playerOccupation, array $isDie)
{
    $result = $playerOccupation;
    while ($result == $playerOccupation) {
        $result = rand(0, 3);
        if ($isDie[$result] == 1) {
            $result = $playerOccupation;
        }
    }
    //echo "result = $result".PHP_EOL;
    return $result;
}

function fight(Hero $player, Hero $enemy)
{
    //先決定誰先攻
    $firstAttack = 0;
    if ($player->speed >= $enemy->speed) {
        //echo "$player->speed , $enemy->speed";
        echo "$player->name 速度比較快，先攻。" . PHP_EOL;
        $firstAttack = 0;
    } else {
        echo "$enemy->name 速度比較快，先攻。" . PHP_EOL;
        $firstAttack = 1;
    }
    $state="";
    printCompetitionState($player, $enemy, $state);
    while ($player->healthPoint >= 0 && $enemy->healthPoint >= 0) {
        if ($firstAttack == 0) {
            if (rand(1, 100) < $player->possToMagicAttack) {
                $player->magicAttack($enemy);
                $state = "$player->name 對 $enemy->name 進行了魔法攻擊";
                printCompetitionState($player, $enemy, $state);
                sleep(1);
                if ($enemy->healthPoint <= 0) {
                    break;
                }
                if (rand(1, 100) < $enemy->possToMagicAttack) {
                    $enemy->magicAttack($player);
                    $state = "$enemy->name 對 $player->name 進行了魔法攻擊";
                    printCompetitionState($player, $enemy, $state);
                    sleep(1);
                    if ($player->healthPoint <= 0) {
                        //$player->healthPoint=0;
                        break;
                    }
                } else {
                    $enemy->attack($player);
                    $state = "$enemy->name 對 $player->name 進行了物理攻擊";
                    printCompetitionState($player, $enemy, $state);
                    sleep(1);
                    if ($player->healthPoint <= 0) {
                        //$player->healthPoint=0;
                        break;
                    }
                }
            } else {
                $player->attack($enemy);
                $state = "$player->name 對 $enemy->name 進行了物理攻擊";
                printCompetitionState($player, $enemy, $state);
                sleep(1);
                if ($enemy->healthPoint <= 0) {
                    break;
                }
                //sleep(1);
                if (rand(1, 100) < $enemy->possToMagicAttack) {
                    $enemy->magicAttack($player);
                    $state = "$enemy->name 對 $player->name 進行了魔法攻擊";
                    printCompetitionState($player, $enemy, $state);
                    sleep(1);
                    if ($player->healthPoint <= 0) {
                        //$player->healthPoint=0;
                        break;
                    }
                } else {
                    $enemy->attack($player);
                    $state = "$enemy->name 對 $player->name 進行了物理攻擊";
                    printCompetitionState($player, $enemy, $state);
                    sleep(1);
                    if ($player->healthPoint <= 0) {
                        //$player->healthPoint=0;
                        break;
                    }
                }
            }
            //printCompetitionState($player, $enemy, $state);
        } elseif ($firstAttack == 1) {
            if (rand(1, 100) < $enemy->possToMagicAttack) {
                $enemy->magicAttack($player);
                $state = "$enemy->name 對 $player->name 進行了魔法攻擊";
                printCompetitionState($player, $enemy, $state);
                sleep(1);
                if ($player->healthPoint <= 0) {
                    //$player->healthPoint=0;
                    break;
                }
                //sleep(1);
                if (rand(1, 100) < $player->possToMagicAttack) {
                    $player->magicAttack($enemy);
                    $state = "$player->name 對 $enemy->name 進行了魔法攻擊";
                    printCompetitionState($player, $enemy, $state);
                    sleep(1);
                    if ($enemy->healthPoint <= 0) {
                        break;
                    }
                } else {
                    $player->attack($enemy);
                    $state = "$player->name 對 $enemy->name 進行了物理攻擊";
                    printCompetitionState($player, $enemy, $state);
                    sleep(1);
                    if ($enemy->healthPoint <= 0) {
                        break;
                    }
                }
            } else {
                $enemy->attack($player);
                $state = "$enemy->name 對 $player->name 進行了物理攻擊";
                printCompetitionState($player, $enemy, $state);
                sleep(1);
                if ($player->healthPoint <= 0) {
                    $player->healthPoint=0;
                    break;
                }
                //sleep(1);
                if (rand(1, 100) < $player->possToMagicAttack) {
                    $player->magicAttack($enemy);
                    $state = "$player->name 對 $enemy->name 進行了魔法攻擊";
                    printCompetitionState($player, $enemy, $state);
                    sleep(1);
                    if ($enemy->healthPoint <= 0) {
                        break;
                    }
                } else {
                    $player->attack($enemy);
                    $state = "$player->name 對 $enemy->name 進行了物理攻擊";
                    printCompetitionState($player, $enemy, $state);
                    sleep(1);
                    if ($enemy->healthPoint <= 0) {
                        break;
                    }
                }
            }
        }
    }
    $i=10;
    while($i--){
        echo PHP_EOL;
    }
}
function printCompetitionResult(Hero $player, Hero $enemy, array $isDie, $enemyOccupation)
{
    echo "戰鬥結束".PHP_EOL;
    $quit = 0;
    for($i=0;$i<4;$i++){
        if($isDie[$i]==1){
            $quit++;
        }
    }
    //echo "quit = $quit".PHP_EOL;
    if($quit==3){
        echo "恭喜你贏得全部的戰鬥".PHP_EOL;
        return 1;
    }else{
        if($player->healthPoint<=0){
            echo "這場的贏家是 $enemy->name".PHP_EOL;
            echo "挑戰失敗，重來吧～".PHP_EOL;
            return 1;
        }else{
            echo "恭喜你獲勝。".PHP_EOL;
            $isDie[$enemyOccupation] = 1;
            sleep(1);
            echo "幫你恢復 $player->selfHeal 點血量".PHP_EOL;
            sleep(1);
            $tmp = $player->healthPoint;
            $player->healthPoint += $player->selfHeal;
            echo "$tmp => $player->healthPoint".PHP_EOL;
            sleep(1);
            echo "恢復完成，準備下一場戰鬥".PHP_EOL;
            sleep(2);
            //return 2;
        }
    }
    return 0;

}

echo "在遙遠的國度裡，有四位勇者，分別是杖之勇者、劍之勇者、盾之勇者、凳之勇者正在爭論誰才是最強的勇者。\n";
echo "最終，他們決定以「挑戰」來決定誰是最強。\n";
echo "只要單槍匹馬挑戰其他三名勇者，並取得最終勝利，就是最強的勇者。\n";
$playerOccupation = selectOccupation();

echo "請輸入你的名字：";
$playerName = fread(STDIN, 80);
$playerName[strlen($playerName)-1]="\0";
echo "Hi, $playerName." . PHP_EOL;
echo "正在分配數據......" . PHP_EOL;
sleep(1);

//
echo "這是你這次挑戰的數值：" . PHP_EOL;
$player = new Hero($playerName);
assignHeroValue($player, $playerOccupation);
echo "HP: $player->healthPoint" . PHP_EOL;
echo "物理攻擊: $player->attack" . PHP_EOL;
echo "物理防禦: $player->defense" . PHP_EOL;
echo "魔法攻擊: $player->magicAttack" . PHP_EOL;
echo "魔法防禦: $player->magicDefense" . PHP_EOL;
echo "每次戰鬥後回血: $player->selfHeal" . PHP_EOL;
echo "速度: $player->speed" . PHP_EOL;
echo "進行魔法攻擊之機率: $player->possToMagicAttack" . PHP_EOL;
sleep(2);
$enemy = array();
$enemy_magic = new Hero("杖之勇者");
$enemy_sword = new Hero("劍之勇者");
$enemy_shield = new Hero("盾之勇者");
$enemy_bench = new Hero("凳之勇者");
assignHeroValue($enemy_magic, 0);
assignHeroValue($enemy_sword, 1);
assignHeroValue($enemy_shield, 2);
assignHeroValue($enemy_bench, 3);
$enemy = array($enemy_magic, $enemy_sword, $enemy_shield, $enemy_bench);
$isDie = array(0, 0, 0, 0);
echo "即將開始挑戰......" . PHP_EOL;
sleep(2);

//$isDie[$playerOccupation]=1;

for ($round = 1; $round < 4; $round++) {
    echo "第 $round 回合開始" . PHP_EOL;
    $enemyOccupation = chooseRandomEnemy($playerOccupation, $isDie);
    $enemyThisRound = $enemy[$enemyOccupation]->name;

    echo "你這回合的對手是: $enemyThisRound" . PHP_EOL;
    $isDie[$enemyOccupation] = 1;

    //printCompetitionState($player)
    fight($player, $enemy[$enemyOccupation]);

    $win = printCompetitionResult($player, $enemy[$enemyOccupation], $isDie, $enemyOccupation);
    if($win){
        break;
    }
}
