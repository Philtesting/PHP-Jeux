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
    private $nomJeux;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $statusP1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $statusP2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $scoreP1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $scoreP2;

    /**
     * @ORM\Column(type="integer")
     */
    private $difficulter;

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

    public function getNomJeux(): ?string
    {
        return $this->nomJeux;
    }

    public function setNomJeux(string $nomJeux): self
    {
        $this->nomJeux = $nomJeux;

        return $this;
    }

    public function getDifficulter(): ?int
    {
        return $this->difficulter;
    }

    public function setDifficulter(int $difficulter): self
    {
        $this->difficulter = $difficulter;

        return $this;
    }

    public function getScoreP1(): ?int
    {
        return $this->scoreP1;
    }

    public function setScoreP1(?int $scoreP1): self
    {
        $this->scoreP1 = $scoreP1;

        return $this;
    }

    public function getScoreP2(): ?int
    {
        return $this->scoreP2;
    }

    public function setScoreP2(?int $scoreP2): self
    {
        $this->scoreP2 = $scoreP2;

        return $this;
    }

    public function getStatusP1(): ?int
    {
        return $this->statusP1;
    }

    public function setStatusP1(?int $statusP1): self
    {
        $this->statusP1 = $statusP1;

        return $this;
    }

    public function getStatusP2(): ?int
    {
        return $this->statusP2;
    }

    public function setStatusP2(?int $statusP2): self
    {
        $this->statusP2 = $statusP2;

        return $this;
    }
}
