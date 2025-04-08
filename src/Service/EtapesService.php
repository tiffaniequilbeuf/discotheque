<?php

namespace App\Service;

use Symfony\Component\Form\AbstractType;
use Psr\Log\LoggerInterface;

class EtapesService extends AbstractType
{
    private array $etapes;

    public function __construct($etapes =     [
        ['year' => 2000, 'event' => 'Ouverture de la discothèque'],
        ['year' => 2003, 'event' => 'Premier événement international avec DJ célèbre'],
        ['year' => 2007, 'event' => 'Renovation et ajout de nouveaux espaces'],
        ['year' => 2010, 'event' => 'Lancement des soirées à thème chaque mois'],
        ['year' => 2018, 'event' => 'Installation d\'un système de son haute technologie'],
    ])
    {
        $this->etapes = $etapes;
    }

    public function logEtapes(LoggerInterface $logger): void
    {
        $etapesStrings = array_map(function ($etape) {
            return $etape['year'] . ' : ' . $etape['event'];
        }, $this->etapes);

        $logger->info(implode("\n", $etapesStrings));
    }

    public function getEtapes()
    {
        return $this->etapes;
    }
}
