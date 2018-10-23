<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswerRepository")
 */
class Answer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\profile", inversedBy="answers")
     */
    private $profile_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\riddle", inversedBy="answers")
     */
    private $riddle_id;

    /**
     * @ORM\Column(type="text")
     */
    private $answerTxt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $correct;

    /**
     * @ORM\Column(type="datetime")
     */
    private $time;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dislikes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfileId(): ?profile
    {
        return $this->profile_id;
    }

    public function setProfileId(?profile $profile_id): self
    {
        $this->profile_id = $profile_id;

        return $this;
    }

    public function getRiddleId(): ?riddle
    {
        return $this->riddle_id;
    }

    public function setRiddleId(?riddle $riddle_id): self
    {
        $this->riddle_id = $riddle_id;

        return $this;
    }

    public function getAnswerTxt(): ?string
    {
        return $this->answerTxt;
    }

    public function setAnswerTxt(string $answerTxt): self
    {
        $this->answerTxt = $answerTxt;

        return $this;
    }

    public function getCorrect(): ?bool
    {
        return $this->correct;
    }

    public function setCorrect(bool $correct): self
    {
        $this->correct = $correct;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(?int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getDislikes(): ?int
    {
        return $this->dislikes;
    }

    public function setDislikes(?int $dislikes): self
    {
        $this->dislikes = $dislikes;

        return $this;
    }
}
