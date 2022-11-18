<?php

require_once 'StringPad.php';

class PlayGround
{
    use StringPad;

    const VIEW_SIZE = 30;
    const MAX_PROGRESS_BAR = 30;

    protected $player;
    protected $enemy;
    protected $playerProgressBar = 0;
    protected $enemyProgressBar = 0;

    public function __construct($player, $enemy)
    {
        $this->player = $player;
        $this->enemy = $enemy;
    }

    public function fight()
    {
        [$attacker, $defender] = $this->round();
        echo PHP_EOL;
        echo "$attacker->name attack $defender->name";
        $attacker->attack($defender);
        if ($attacker->isPlayer() && $defender->isDead()) {
            $attacker->addExperience($defender->experience);
        }
        $this->print();
        $this->showProgressBar();
        if ($defender->isPlayer() && $defender->isDead()) {
            die(PHP_EOL . 'game over');
        }
    }

    public function setEnemy($enemy)
    {
        $this->enemy = $enemy;
    }

    public function print()
    {
        $playerStates = $this->player->states();
        $enemyStates = $this->enemy->states();
        $results = [];
        foreach ($playerStates as $index => $playerState) {
            $results[$index] = $this->pad($playerState, self::VIEW_SIZE, ' ', STR_PAD_RIGHT)
                . '|'
                . $this->pad($enemyStates[$index], self::VIEW_SIZE);
        }
        echo chr(27) . "[0G";
        echo chr(27) . "[10A";
        echo implode('' . PHP_EOL, $results);
        echo PHP_EOL;
    }

    protected function round()
    {
        do {
            $this->playerProgressBar += $this->player->speed;
            $this->enemyProgressBar += $this->enemy->speed;
            $this->showProgressBar();
            sleep(1);
        } while (
            $this->playerProgressBar <= self::MAX_PROGRESS_BAR &&
            $this->enemyProgressBar <= self::MAX_PROGRESS_BAR);

        if ($this->playerProgressBar >= self::MAX_PROGRESS_BAR) {
            $this->playerProgressBar -= self::MAX_PROGRESS_BAR;
            return [$this->player, $this->enemy];
        }

        if ($this->enemyProgressBar >= self::MAX_PROGRESS_BAR) {
            $this->enemyProgressBar -= self::MAX_PROGRESS_BAR;
            return [$this->enemy, $this->player];
        }
    }

    private function showProgressBar()
    {
        $playerProgressBar = $this->stringRepeats($this->playerProgressBar, STR_PAD_RIGHT);
        $enemyProgressBar = $this->stringRepeats($this->enemyProgressBar, STR_PAD_LEFT);
        echo chr(27) . "[0G";
        echo $this->pad($playerProgressBar, self::VIEW_SIZE, ' ', STR_PAD_RIGHT)
            . '|'
            . $this->pad($enemyProgressBar, self::VIEW_SIZE);
    }

    private function stringRepeats($count, $pad)
    {
        $count = min([$count, self::MAX_PROGRESS_BAR]);
        $repeats = floor($count / self::MAX_PROGRESS_BAR * self::VIEW_SIZE);
        $bar = str_repeat("=", $repeats);
        return str_pad($bar, self::VIEW_SIZE, ' ', $pad);
    }
}