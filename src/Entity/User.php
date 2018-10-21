<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Email()
    */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $riddling_score;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $admin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Riddle", mappedBy="user_id")
     */
    private $riddle_id;

    public function __construct()
    {
        $this->riddle_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRiddlingScore(): ?int
    {
        return $this->riddling_score;
    }

    public function setRiddlingScore(?int $riddling_score): self
    {
        $this->riddling_score = $riddling_score;

        return $this;
    }

    public function getAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * @return Collection|Riddle[]
     */
    public function getRiddleId(): Collection
    {
        return $this->riddle_id;
    }

    public function addRiddleId(Riddle $riddleId): self
    {
        if (!$this->riddle_id->contains($riddleId)) {
            $this->riddle_id[] = $riddleId;
            $riddleId->setUserId($this);
        }

        return $this;
    }

    public function removeRiddleId(Riddle $riddleId): self
    {
        if ($this->riddle_id->contains($riddleId)) {
            $this->riddle_id->removeElement($riddleId);
            // set the owning side to null (unless already changed)
            if ($riddleId->getUserId() === $this) {
                $riddleId->setUserId(null);
            }
        }

        return $this;
    }

    
}
