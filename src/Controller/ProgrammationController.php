<?php

namespace App\Controller;

use App\Entity\Programmation;
use App\Form\ProgrammationType;
use App\Repository\ProgrammationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/programmation')]
final class ProgrammationController extends AbstractController
{
    #[Route(name: 'app_programmation_index', methods: ['GET'])]
    public function index(ProgrammationRepository $programmationRepository): Response
    {
        return $this->render('programmation/index.html.twig', [
            'programmations' => $programmationRepository->findAll(),
            'page_title' => '',
        ]);
    }

    #[Route('/new', name: 'app_programmation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $programmation = new Programmation();
        $form = $this->createForm(ProgrammationType::class, $programmation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($programmation);
            $entityManager->flush();

            return $this->redirectToRoute('app_programmation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('programmation/new.html.twig', [
            'programmation' => $programmation,
            'form' => $form,
            'page_title' => '',
        ]);
    }

    #[Route('/{id}', name: 'app_programmation_show', methods: ['GET'])]
    public function show(Programmation $programmation): Response
    {
        return $this->render('programmation/show.html.twig', [
            'programmation' => $programmation,
            'page_title' => "",
        ]);
    }

    #[Route('/{id}/edit', name: 'app_programmation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Programmation $programmation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProgrammationType::class, $programmation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_programmation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('programmation/edit.html.twig', [
            'programmation' => $programmation,
            'form' => $form,
            'page_title' => "",
        ]);
    }

    #[Route('/{id}', name: 'app_programmation_delete', methods: ['POST'])]
    public function delete(Request $request, Programmation $programmation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$programmation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($programmation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_programmation_index', [], Response::HTTP_SEE_OTHER);
    }
}
