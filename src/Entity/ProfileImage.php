<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfileImageRepository")
 */
class ProfileImage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profile", inversedBy="profileImages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profile_id;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image_path;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active_state;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImagePath(): ?string
    {
        return $this->image_path;
    }

    public function setImagePath(string $image_path): self
    {
        $this->image_path = $image_path;

        return $this;
    }

    public function getActiveState(): ?bool
    {
        return $this->active_state;
    }

    public function setActiveState(bool $active_state): self
    {
        $this->active_state = $active_state;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
}
