<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TvShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[
    ORM\Entity(repositoryClass: TvShowRepository::class),
    ORM\Index(name: 'idx_tv_show_title', columns: ['title']),
    ORM\Index(name: 'idx_tv_show_channel', columns: ['channel']),
]
class TvShow
{
    #[
        ORM\Id,
        ORM\GeneratedValue,
        ORM\Column(type: 'integer', nullable: false),
    ]
    private ?int $id = null;

    #[
        ORM\Column(type: 'string', length: 200),
        Assert\NotBlank,
        Assert\NotNull,
        Assert\Length(min: 1, max: 200),
    ]
    private string $title = '';

    #[
        ORM\Column(type: 'string', length: 200),
        Assert\NotBlank,
        Assert\NotNull,
        Assert\Length(min: 1, max: 200),
    ]
    private string $genre = '';

    #[
        ORM\Column(type: 'string', length: 200),
        Assert\NotBlank,
        Assert\NotNull,
        Assert\Length(min: 1, max: 200),
    ]
    private string $channel = '';

    /** @var Collection<int, TvShowInterval> */
    #[
        ORM\OneToMany(targetEntity: TvShowInterval::class, mappedBy: 'tvShow', cascade: ['persist', 'remove'], orphanRemoval: true),
        Assert\Valid,
        ORM\OrderBy(['weekDay' => 'ASC', 'showTime' => 'ASC']),
    ]
    private Collection $intervals;

    public function __construct()
    {
        $this->intervals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): TvShow
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): TvShow
    {
        $this->title = $title;
        return $this;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): TvShow
    {
        $this->genre = $genre;
        return $this;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function setChannel(string $channel): TvShow
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * @return Collection<int, TvShowInterval>
     */
    public function getIntervals(): Collection
    {
        return $this->intervals;
    }

    /**
     * @param Collection<int, TvShowInterval> $intervals
     * @return $this
     */
    public function setIntervals(Collection $intervals): TvShow
    {
        $this->intervals = $intervals;
        return $this;
    }

    public function hasInterval(TvShowInterval $interval): bool
    {
        if ($this->intervals->contains($interval)) {
            return true;
        }
        return false;
    }

    public function addInterval(TvShowInterval $interval): self
    {
        if (! $this->hasInterval($interval)) {
            $this->intervals[] = $interval;
            $interval->setTvShow($this);
        }
        return $this;
    }

    public function removeInterval(TvShowInterval $interval): self
    {
        if ($this->hasInterval($interval)) {
            $this->intervals->removeElement($interval);
        }
        return $this;
    }

    public function __toString(): string
    {
        return sprintf('%s (%s)', $this->getTitle(), $this->getChannel());
    }
}
