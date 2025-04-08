<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\EtapesService;

final class GlobalController extends AbstractController
{
    #[Route('/', name: 'app_welcome')]
    public function index(): Response
    {
        return $this->render('global/index.html.twig', [
            'page_title' => 'Hello World',
        ]);
    }
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData());
        }
        return $this->render('global/contact.html.twig', [
            'page_title' => 'contact',
            'form' => $form,
        ]);
    }
    #[Route('/about-us', name: 'app_about_us')]
    public function aboutUs(EtapesService $etapesService): Response
    {
        $etapes = $etapesService->getEtapes();
        return $this->render('global/about-us.html.twig', [
            'page_title' => 'à propos',
            'etapes' => $etapes,
        ]);
    }

    #[Route('api/etapes')]
    public function apiEtapes(EtapesService $etapes_service)
    {
        return $this->json($etapes_service);
    }

    /*Créer dans un contrôleur une route qui renvoie une étape aléatoire.
        A partir du tableau Api/Etapes sélectionner un [ ] aléatoire ->AJAX
        utiliser un random https://www.php.net/manual/fr/function.rand.php

    Créer sur la page d’accueil une zone contenant l’année et le texte de cette l’étape.
    Ajouter du JavaScript pour récupérer et afficher la nouvelle étape à chaque chargement de cette page
    
    */
    // #[Route('/teaser', name: 'teaser')]
    // public function showRandom(EtapesService $etapes_service): Response
    // {
    //     return $this->apiEtapes();
    // }

    #[Route('/teaser', name: 'teaser')]
    public function showRandom()
    {
        echo 'chat';
    }
}
