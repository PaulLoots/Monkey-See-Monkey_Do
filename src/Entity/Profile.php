<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfileRepository")
 */
class Profile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
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
     * @ORM\OneToMany(targetEntity="App\Entity\Riddle", mappedBy="profile_id")
     */
    private $riddles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Answer", mappedBy="profile_id")
     */
    private $answers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProfileImage", mappedBy="profile_id")
     */
    private $profileImages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="profile_id", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $banned;

    public function __construct()
    {
        $this->riddles = new ArrayCollection();
        $this->answers = new ArrayCollection();
        $this->profileImages = new ArrayCollection();
        $this->comments = new ArrayCollection();
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
    public function getRiddles(): Collection
    {
        return $this->riddles;
    }

    public function addRiddle(Riddle $riddle): self
    {
        if (!$this->riddles->contains($riddle)) {
            $this->riddles[] = $riddle;
            $riddle->setProfileId($this);
        }

        return $this;
    }

    public function removeRiddle(Riddle $riddle): self
    {
        if ($this->riddles->contains($riddle)) {
            $this->riddles->removeElement($riddle);
            // set the owning side to null (unless already changed)
            if ($riddle->getProfileId() === $this) {
                $riddle->setProfileId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setProfileId($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
            // set the owning side to null (unless already changed)
            if ($answer->getProfileId() === $this) {
                $answer->setProfileId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProfileImage[]
     */
    public function getProfileImages(): Collection
    {
        return $this->profileImages;
    }

    public function addProfileImage(ProfileImage $profileImage): self
    {
        if (!$this->profileImages->contains($profileImage)) {
            $this->profileImages[] = $profileImage;
            $profileImage->setProfileId($this);
        }

        return $this;
    }

    public function removeProfileImage(ProfileImage $profileImage): self
    {
        if ($this->profileImages->contains($profileImage)) {
            $this->profileImages->removeElement($profileImage);
            // set the owning side to null (unless already changed)
            if ($profileImage->getProfileId() === $this) {
                $profileImage->setProfileId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setProfileId($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getProfileId() === $this) {
                $comment->setProfileId(null);
            }
        }

        return $this;
    }

    public function getBanned(): ?bool
    {
        return $this->banned;
    }

    public function setBanned(?bool $banned): self
    {
        $this->banned = $banned;

        return $this;
    }
}
