<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TvShowIntervalRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[
    ORM\Entity(repositoryClass: TvShowIntervalRepository::class),
    ORM\Index(name: 'idx_tv_show_interval_week_day', columns: ['week_day']),
    ORM\Index(name: 'idx_tv_show_interval_show_time', columns: ['show_time']),
]
class TvShowInterval
{
    private const DOW = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    #[
        ORM\Id,
        ORM\GeneratedValue,
        ORM\Column(type: 'integer', nullable: false),
    ]
    private ?int $id = null;

    #[
        ORM\Column(type: 'integer'),
        Assert\GreaterThanOrEqual(0),
        Assert\LessThanOrEqual(6),
    ]
    private ?int $weekDay = null;

    #[
        ORM\Column(type: 'integer'),
        Assert\GreaterThanOrEqual(0),
        Assert\LessThanOrEqual(1439),
    ]
    private ?int $showTime = null;

    #[
        ORM\ManyToOne(targetEntity: TvShow::class, inversedBy: 'intervals'),
        ORM\JoinColumn(nullable: false),
    ]
    protected TvShow $tvShow;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): TvShowInterval
    {
        $this->id = $id;
        return $this;
    }

    public function getWeekDay(): ?int
    {
        return $this->weekDay;
    }

    public function isWeekDayToday(): bool
    {
        if ($this->weekDay === null) {
            return false;
        }
        $dateTime = new \DateTime();
        return intval($dateTime->format('w')) === $this->weekDay;
    }

    public function getWeekDayAsString(): ?string
    {
        if ($this->weekDay === null) {
            return null;
        }
        return self::DOW[$this->weekDay];
    }

    public function setWeekDay(?int $weekDay): TvShowInterval
    {
        $this->weekDay = $weekDay;
        return $this;
    }

    public function getShowTime(): ?int
    {
        return $this->showTime;
    }

    public function getShowTimeAsString(): ?string
    {
        if ($this->showTime === null) {
            return null;
        }
        $dateTime = new \DateTime();
        $dateTime->setTime(intval($this->showTime / 60), $this->showTime % 60);
        return $dateTime->format('H:i');
    }

    public function setShowTime(?int $showTime): TvShowInterval
    {
        $this->showTime = $showTime;
        return $this;
    }

    public function getTvShow(): TvShow
    {
        return $this->tvShow;
    }

    public function setTvShow(TvShow $tvShow): TvShowInterval
    {
        $this->tvShow = $tvShow;
        return $this;
    }
}
