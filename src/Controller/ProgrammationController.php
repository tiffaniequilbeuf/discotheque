<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Programmation;
use App\Form\ProgrammationType;
use App\Repository\ProgrammationRepository;

final class ProgrammationController extends AbstractController
{   
    #[Route('/event', name: 'app_event')]
    public function index(): Response
    {
        return $this->render('programmation/index.html.twig', [
            'controller_name' => 'ProgrammationController',
            // 'events' =>$this->programmation(ProgrammationRepository::class),
        ]);
    }

    #[Route('event/create')]
    // Ajouter une donnée depuis Symfony (moins brutal que directement dans la BDD, pour l'exercice)
    // public function createEvent(EntityManagerInterface $em):Response{
    //     $event = new Programmation();
    //     $event->setName("King K'Rock");
    //     $event->setDateParty(new \DateTime);
    //     $event->setDescription('ça rock avec le roi Croco !');
    //     $event->setCreateAt(new \DateTimeImmutable);

    //     $em->persist($event);
    //     $em->flush();

    //     return new Response("créé avec l'id".$event->getId());
    // }

    public function createEvent(Request $request, EntityManagerInterface $em): Response
    {
        $event = new Programmation();
        $form = $this->createForm(ProgrammationType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event->setCreateAt(new \DateTimeImmutable());
            $em->persist($event);
            $em->flush();
            dd($event);
        }
        return $this->render('programmation/index.html.twig', [
            'page_title' => 'évenement',
            'form' => $form,
        ]);
    }

    #[Route('/programmation')]
    // public function programmation(EntityManagerInterface $em){
    //     $repositoryProgrammation=$em->getRepository(Programmation::class);
    //     $events=$repositoryProgrammation->findAll();
    //     dd($events);
    // }

    public function programmation(ProgrammationRepository $programmationRepository)
    {
        $events = $programmationRepository->findAll();
        // return $events;
        // dd($events);
    }

    #[Route('/programmation/show/{id}')]
    public function show(ProgrammationRepository $programmationRepository, $id)
    {
        $event = $programmationRepository->find($id);
        dd($event);
    }
    // function show(ProgrammationRepository $programmationRepository): Response {
    //     dd($programmationRepository);
    // }

    #[Route('/programmation/update/{id}')]
    public function update(EntityManagerInterface $entityManager, int $id)
    {
        $event = $entityManager->getRepository(Programmation::class)->find($id);

        if (!$event) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $event->setName('DiscoBear');
        $entityManager->flush();

        dd($event);
            // return $this->redirectToRoute('product_show', [
            //     'id' => $event->getId()
            // ])
        ;
    }


    #[Route('/programmation/delete/{id}')]
    public function delete(EntityManagerInterface $entityManager, int $id)
    {
        $event = $entityManager->getRepository(Programmation::class)->find($id);

        if (!$event) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }
        $entityManager->remove($event);
        $entityManager->flush();
        dd($event);
    }
}
