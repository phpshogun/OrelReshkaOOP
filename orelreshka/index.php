<?php

class Player
{
    public $name;
    public $coins;

    public function __construct($name, $coins)
    {
       $this->name = $name;
       $this->coins = $coins;
    }

    public function point(Player $player)
    {
        $this->coins++;
        $player->coins--;
    }

    public function bankrupt()
    {
        return $this->coins == 0;
    }

    public function bank()
    {
        return  $this->coins;
    }
}


class Game {
    protected $player1;
    protected $player2;
    protected $flips = 1;

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function flip()
    {
        return rand(0,1) ? "орел" : "решка";
    }

    public function start()
    {  while(true) {
        //Подбросить монету



        //Если орел, п1 получает монету, п2 теряет и наоборот
        if($this->flip() == "орел")
        {   $this->player1->point($this->player2);
        } else {
            $this->player2->point($this->player1);
        }
        //Если у кого-то кол-во монет будет 0, то игра окончена. Победитель тот, у кого больше монет.
        if($this->player1->bankrupt() || $this->player2->bankrupt()) {
            return $this->end();
        }

        $this->flips++;
    }
    }
    public function winner()
    {
        if($this->player1->bank() > $this->player2->bank()) {
            return $this->player1;
        } else {
            return $this->player2;
        }

    }
    public function end()
    {

        echo <<<EOT
            Game over.
            {$this->player1->name}: {$this->player1->coins}
            {$this->player2->name}: {$this->player2->coins}
            
            Кол-во бросков: {$this->flips}
            
            Победитель: {$this->winner()->name}
EOT;

    }
}

$game = new Game (
    new Player("Shogun", 100),
    new Player("Valentina", 100)
);

$game ->start();