<?php

namespace App\Controller;

use App\Entity\EventMateriel;
use App\Form\EventMaterielType;
use App\Repository\EventMaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/event/materiel')]
final class EventMaterielController extends AbstractController
{
    #[Route(name: 'app_event_materiel_index', methods: ['GET'])]
    public function index(EventMaterielRepository $eventMaterielRepository): Response
    {
        return $this->render('event_materiel/index.html.twig', [
            'event_materiels' => $eventMaterielRepository->findAll(),
            'page_title' => "Organisation",
        ]);
    }

    #[Route('/new', name: 'app_event_materiel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $eventMateriel = new EventMateriel();
        $form = $this->createForm(EventMaterielType::class, $eventMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($eventMateriel);
            $entityManager->flush();

            return $this->redirectToRoute('app_event_materiel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event_materiel/new.html.twig', [
            'event_materiel' => $eventMateriel,
            'form' => $form,
            'page_title' => "",
        ]);
    }

    #[Route('/{id}', name: 'app_event_materiel_show', methods: ['GET'])]
    public function show(EventMateriel $eventMateriel): Response
    {
        return $this->render('event_materiel/show.html.twig', [
            'event_materiel' => $eventMateriel,
            'page_title' => "",
        ]);
    }

    #[Route('/{id}/edit', name: 'app_event_materiel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EventMateriel $eventMateriel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventMaterielType::class, $eventMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_event_materiel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event_materiel/edit.html.twig', [
            'event_materiel' => $eventMateriel,
            'form' => $form,
            'page_title' => "",
        ]);
    }

    #[Route('/{id}', name: 'app_event_materiel_delete', methods: ['POST'])]
    public function delete(Request $request, EventMateriel $eventMateriel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eventMateriel->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($eventMateriel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_event_materiel_index', [], Response::HTTP_SEE_OTHER);
    }
}
