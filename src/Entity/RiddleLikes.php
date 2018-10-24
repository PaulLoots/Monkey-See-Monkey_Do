<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RiddleLikesRepository")
 */
class RiddleLikes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Riddle", inversedBy="riddleLikes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $riddle_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profile", inversedBy="riddleLikes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profile_id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $liked;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $disliked;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRiddleId(): ?Riddle
    {
        return $this->riddle_id;
    }

    public function setRiddleId(?Riddle $riddle_id): self
    {
        $this->riddle_id = $riddle_id;

        return $this;
    }

    public function getProfileId(): ?Profile
    {
        return $this->profile_id;
    }

    public function setProfileId(?Profile $profile_id): self
    {
        $this->profile_id = $profile_id;

        return $this;
    }

    public function getLiked(): ?bool
    {
        return $this->liked;
    }

    public function setLiked(?bool $liked): self
    {
        $this->liked = $liked;

        return $this;
    }

    public function getDisliked(): ?bool
    {
        return $this->disliked;
    }

    public function setDisliked(?bool $disliked): self
    {
        $this->disliked = $disliked;

        return $this;
    }
}
