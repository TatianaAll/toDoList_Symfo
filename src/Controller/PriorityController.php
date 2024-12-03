<?php

namespace App\Controller;

use App\Entity\Priority;
use App\Form\PriorityType;
use App\Repository\PriorityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PriorityController extends AbstractController
{
    #[Route('/priority', name: 'priority')]
    public function index(PriorityRepository $priorityRepository): Response
    {
        $priorities = $priorityRepository->findAll();

        return $this->render('priority/index.html.twig', [
            'priorities' => $priorities,
        ]);
    }

    #[Route('/priority/create', name: 'priority_create')]
    public function createPriority(EntityManagerInterface $entityManager, Request $request): Response
    {
        //1- je crée une nouvelle instance
        $priority = new Priority();

        //2- j'appelle le form avec son type et ce qu'il va remplir
        $form = $this->createForm(PriorityType::class, $priority);
        //3- j'appelle mon formView pour mon twig
        $formView = $form->createView();
        //4- je récupère le résultat de ma requete
        $form->handleRequest($request);

        //si le form a été soumis alors
        if ($form->isSubmitted()) {
            //5- je commit dans ma DB
            $entityManager->persist($priority);
            //6- je push dans ma DB
            $entityManager->flush();

            //7- je renvoie vers la page de listing de mes priorité
            return $this->redirectToRoute('priority');
        }
        //je n'oublie pas de renvoyer la vue de mon formulaire
        return $this->render('priority/create.html.twig', ['formView' => $formView]);
    }
}
