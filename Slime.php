<?php

require_once('Character.php');

class Slime extends Character
{
    protected function assignAttributes()
    {
        $this->HP = $this->maxHP = rand(3, 8);
        $this->MP = $this->maxMP = rand(0, 5);
        $this->attack = rand(1, 3);
        $this->defense = rand(0, 1);
        $this->magicAttack = rand(1, 5);
        $this->magicDefense = rand(0, 1);
        $this->speed = rand(2, 5);
        $this->experience = rand(30, 50);
    }
}