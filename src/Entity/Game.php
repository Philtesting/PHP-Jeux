<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $playerOne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\users", inversedBy="games")
     */
    private $playerTwo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameGame;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $topScore;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\users")
     */
    private $winner;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdGame(): ?int
    {
        return $this->idGame;
    }

    public function setIdGame(int $idGame): self
    {
        $this->idGame = $idGame;

        return $this;
    }

    public function getPlayerOne(): ?Users
    {
        return $this->playerOne;
    }

    public function setPlayerOne(?Users $playerOne): self
    {
        $this->playerOne = $playerOne;

        return $this;
    }

    public function getPlayerTwo(): ?users
    {
        return $this->playerTwo;
    }

    public function setPlayerTwo(?users $playerTwo): self
    {
        $this->playerTwo = $playerTwo;

        return $this;
    }

    public function getNameGame(): ?string
    {
        return $this->nameGame;
    }

    public function setNameGame(string $nameGame): self
    {
        $this->nameGame = $nameGame;

        return $this;
    }

    public function getTopScore(): ?int
    {
        return $this->topScore;
    }

    public function setTopScore(?int $topScore): self
    {
        $this->topScore = $topScore;

        return $this;
    }

    public function getWinner(): ?users
    {
        return $this->winner;
    }

    public function setWinner(?users $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }
}
