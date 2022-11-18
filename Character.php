<?php

require_once 'StringPad.php';

abstract class Character
{
    use StringPad;

    protected $level = 1;
    protected $name;
    protected $HP;
    protected $maxHP;
    protected $MP;
    protected $maxMP;
    protected $attack;
    protected $defense;
    protected $magicAttack;
    protected $magicDefense;
    protected $speed;
    protected $experience = 0;
    protected $isPlayer = false;

    abstract protected function assignAttributes();

    public function __construct($name)
    {
        $this->name = $name;
        $this->assignAttributes();
    }

    public function attack($defender)
    {
        $maxDamage = ($this->attack - $defender->defense) > 0 ?
            $this->attack - $defender->defense :
            1;
        $damage = random_int(1, $maxDamage);
        $defender->hurt($damage);
    }

    public function isPlayer()
    {
        return $this->isPlayer;
    }

    public function states()
    {
        $level = $this->pad($this->level);
        $currentHP = $this->pad($this->HP > 0 ? $this->HP : 0);
        $currentMP = $this->pad($this->MP > 0 ? $this->MP : 0);
        $maxHP = $this->pad($this->maxHP);
        $maxMP = $this->pad($this->maxMP);
        $attack = $this->pad($this->attack);
        $defense = $this->pad($this->defense);
        $magicAttack = $this->pad($this->magicAttack);
        $magicDefense = $this->pad($this->magicDefense);
        $speed = $this->pad($this->speed);
        $states[] = "level:$level";
        $states[] = "name:" . $this->name;
        $states[] = "HP:$currentHP/$maxHP";
        $states[] = "MP:$currentMP/$maxMP";
        $states[] = "attack:$attack";
        $states[] = "defense:$defense";
        $states[] = "magicAttack:$magicAttack";
        $states[] = "magicDefense:$magicDefense";
        $states[] = "speed:$speed";
        return $states;
    }

    public function __get($attribute)
    {
        return $this->{$attribute};
    }

    public function hurt($harm)
    {
        return $this->HP -= $harm;
    }

    public function isDead()
    {
        return $this->HP <= 0;
    }
}