<?php
require_once 'vendor/autoload.php';
class Hero
{
    public string $name;
    public int $HP;
    public int $MP;
    public function __construct($name, $HP, $MP = 5)
    {
        $this->name = $name;
        $this->HP = $HP;
        $this->MP = $MP;
        echo "英雄名字是" . $this->name . "\n血量是" . $this->HP . "\n魔力是" . $this->MP . "\n";
    }
}

class Event
{
    public function burn(Hero $hero)
    {
        echo $hero->name . "遇到事件 burn:逐漸扣血-10直到死亡\n";
        while ($hero->HP > 0) {
            $hero->HP -= 10;
            echo $hero->HP > 0 ? "" . $hero->name . "的血量剩" . $hero->HP . "\n" : $hero->name . "已死亡";
        }
    }
}
$faker = Faker\Factory::create();
$heroName = $faker->name();
$heroHP = rand(50, 100);
$hero = new Hero($heroName, $heroHP);
$event = new Event();
$event->burn($hero);
