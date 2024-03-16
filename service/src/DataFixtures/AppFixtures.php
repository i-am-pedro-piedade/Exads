<?php

namespace App\DataFixtures;

use App\Entity\TvShow;
use App\Entity\TvShowInterval;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Random\RandomException;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->createShows($manager);
        $manager->flush();
    }

    private function createShows(ObjectManager $manager): void
    {
        foreach ($this->getShows() as $show) {
            $entity = (new TvShow())
                ->setTitle($show['title'])
                ->setChannel($show['channel'])
                ->setGenre($show['genre']);

            $randomSchedules = $this->generateRandomSchedules();
            foreach ($randomSchedules as $randomSchedule) {
                $showInterval = (new TvShowInterval())
                    ->setWeekDay($randomSchedule['weekDay'])
                    ->setShowTime($randomSchedule['showTime']);
                $entity->addInterval($showInterval);
            }
            $manager->persist($entity);
        }
        $manager->flush();
    }

    private function getShows(): \Generator
    {
        yield ['title' => 'The Mandalorian', 'channel' => 'Disney+', 'genre' => 'Science Fiction'];
        yield ['title' => 'The Walking Dead', 'channel' => 'Netflix', 'genre' => 'Horror'];
        yield ['title' => 'Friends', 'channel' => 'NBC', 'genre' => 'Comedy'];
        yield ['title' => 'Game of Thrones', 'channel' => 'HBO', 'genre' => 'Fantasy'];
        yield ['title' => 'The Office', 'channel' => 'Netflix', 'genre' => 'Comedy'];
        yield ['title' => 'Black Mirror', 'channel' => 'Netflix', 'genre' => 'Drama'];
        yield ['title' => 'Sherlock', 'channel' => 'BBC', 'genre' => 'Mystery'];
        yield ['title' => 'Peaky Blinders', 'channel' => 'BBC', 'genre' => 'Drama'];
        yield ['title' => 'The Crown', 'channel' => 'Netflix', 'genre' => 'Drama'];
        yield ['title' => 'The Witcher', 'channel' => 'Netflix', 'genre' => 'Fantasy'];
        yield ['title' => 'The Umbrella Academy', 'channel' => 'Netflix', 'genre' => 'Science Fiction'];
        yield ['title' => 'Breaking Bad', 'channel' => 'AMC', 'genre' => 'Drama'];
        yield ['title' => 'Loki', 'channel' => 'Disney+', 'genre' => 'Superheroes'];
        yield ['title' => 'The Boys', 'channel' => 'Prime Video', 'genre' => 'Superheroes'];
        yield ['title' => 'Westworld', 'channel' => 'HBO', 'genre' => 'Science Fiction'];
        yield ['title' => 'Money Heist', 'channel' => 'Netflix', 'genre' => 'Crime'];
        yield ['title' => 'Vikings', 'channel' => 'Prime Video', 'genre' => 'Historical Drama'];
        yield ['title' => 'Stranger Things', 'channel' => 'Netflix', 'genre' => 'Science Fiction'];
        yield ['title' => 'The Simpsons', 'channel' => 'Prime Video', 'genre' => 'Animation'];
    }

    /**
     * @return array<int, array<string, int>>
     * @throws RandomException
     */
    public function generateRandomSchedules(): array
    {
        $numberOfSlots = random_int(1, 10);
        $schedules = [];
        for ($i = 0; $i < $numberOfSlots; $i++) {
            $schedules[] = [
                'weekDay' => random_int(0, 6),
                'showTime' => random_int(0, 23) * 60 + 5 * random_int(0, 12)
            ];
        }
        return $schedules;
    }
}
