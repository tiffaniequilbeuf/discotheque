<?php

namespace App\Service;

use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Form\AbstractType;
use App\Controller\GlobalController;

class SelectTeaser extends AbstractType
{
    #[Route('/teaser', name: 'teaser')]
    public function showRandom(GlobalController $global_controller): Response
    {
        $this->apiEtapes();
    }
}
