<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Programmation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $event = new Programmation();
        $event->setName('Steak au Zor');
        $event->setDateParty(new \DateTime('2024-12-24'));
        $event->setDescription('Accompagnés de Duplo-docus, (il y en a 2).');
        $event->setCreateAt(new \DateTimeImmutable('now'));
        $manager->persist($event);
        $manager->flush();
    }
}
