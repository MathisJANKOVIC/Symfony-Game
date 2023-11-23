<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScoreRepository::class)]
class Score
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_user = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Word $id_word = null;

    #[ORM\Column]
    private ?bool $liked = null;

    #[ORM\Column]
    private ?int $attempt_count = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(User $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdWord(): ?Word
    {
        return $this->id_word;
    }

    public function setIdWord(Word $id_word): static
    {
        $this->id_word = $id_word;

        return $this;
    }

    public function isLiked(): ?bool
    {
        return $this->liked;
    }

    public function setLiked(bool $liked): static
    {
        $this->liked = $liked;

        return $this;
    }

    public function getAttemptCount(): ?int
    {
        return $this->attempt_count;
    }

    public function setAttemptCount(int $attempt_count): static
    {
        $this->attempt_count = $attempt_count;

        return $this;
    }
}
