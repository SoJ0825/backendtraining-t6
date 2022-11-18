<?php

require_once 'Character.php';

class Player extends Character
{
    protected $isPlayer = true;

    public function addExperience($value)
    {
        $this->experience += $value;
        if ($this->experience >= 100) {
            $this->levelUp();
            $this->experience -= 100;
        }
    }

    protected function assignAttributes()
    {
        $this->HP = $this->maxHP = random_int(90, 100);
        $this->MP = $this->maxMP = random_int(90, 100);
        $this->attack = rand(3, 4);
        $this->defense = rand(0, 1);
        $this->magicAttack = rand(12, 15);
        $this->magicDefense = rand(0, 1);
        $this->speed = rand(2, 10);
    }

    protected function levelUp()
    {
        $this->level += 1;
        $increaseHP = random_int(5, 10);
        $increaseMP = random_int(0, 3);
        $this->HP += $increaseHP;
        $this->maxHP += $increaseHP;
        $this->MP += $increaseMP;
        $this->maxMP += $increaseMP;
        $this->attack += random_int(0, 2);
        $this->defense += random_int(0, 2);
        $this->magicAttack += random_int(0, 2);
        $this->magicDefense += random_int(0, 2);
    }
}