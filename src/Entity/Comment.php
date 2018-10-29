<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\profile", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profile_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\answer", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $answer_id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $commentTxt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dislikes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $time;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $reported;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isGif;

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

    public function getAnswerId(): ?answer
    {
        return $this->answer_id;
    }

    public function setAnswerId(?answer $answer_id): self
    {
        $this->answer_id = $answer_id;

        return $this;
    }

    public function getCommentTxt(): ?string
    {
        return $this->commentTxt;
    }

    public function setCommentTxt(string $commentTxt): self
    {
        $this->commentTxt = $commentTxt;

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

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getReported(): ?bool
    {
        return $this->reported;
    }

    public function setReported(?bool $reported): self
    {
        $this->reported = $reported;

        return $this;
    }

    public function getIsGif(): ?bool
    {
        return $this->isGif;
    }

    public function setIsGif(?bool $isGif): self
    {
        $this->isGif = $isGif;

        return $this;
    }
}
