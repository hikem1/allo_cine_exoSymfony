<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $releasedDate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $synopsis = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Composer $composer = null;

    #[ORM\ManyToMany(targetEntity: Actor::class, mappedBy: 'movie')]
    private Collection $actors;

    #[ORM\ManyToMany(targetEntity: Director::class, mappedBy: 'movie')]
    private Collection $directors;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->directors = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getReleasedDate(): ?\DateTimeInterface
    {
        return $this->releasedDate;
    }

    public function setReleasedDate(\DateTimeInterface $releasedDate): self
    {
        $this->releasedDate = $releasedDate;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getComposer(): ?Composer
    {
        return $this->composer;
    }

    public function setComposer(?Composer $composer): self
    {
        $this->composer = $composer;

        return $this;
    }

    /**
     * @return Collection<int, Actor>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors->add($actor);
            $actor->addMovie($this);
        }

        return $this;
    }

    public function removeActor(Actor $actor): self
    {
        if ($this->actors->removeElement($actor)) {
            $actor->removeMovie($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Director>
     */
    public function getDirectors(): Collection
    {
        return $this->directors;
    }

    public function addDirector(Director $director): self
    {
        if (!$this->directors->contains($director)) {
            $this->directors->add($director);
            $director->addMovie($this);
        }

        return $this;
    }

    public function removeDirector(Director $director): self
    {
        if ($this->directors->removeElement($director)) {
            $director->removeMovie($this);
        }

        return $this;
    }


}
