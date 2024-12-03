<?php

namespace App\Controller;

use App\Form\StatusType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Status;
use App\Repository\StatusRepository;

class StatusController extends AbstractController
{
    #[Route(path: '/status', name: 'status')]
    public function index(StatusRepository $statusRepository): Response
    {
        $status = $statusRepository->findAll();

        return $this->render('status/index.html.twig', [
            'status' => $status,
        ]);
    }

    #[Route(path: '/status/create', name: 'status_create')]
    public function createStatus(Request $request, EntityManagerInterface $entityManager): Response
    {
        //dd('coucou');
        $status = new Status();

        $form = $this->createForm(StatusType::class, $status);
        $formView = $form->createView();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            //dd($status);
            $entityManager->persist($status);
            $entityManager->flush();

            return $this->redirectToRoute('status');
        }
        return $this->render('status/create.html.twig', ['formView'=>$formView]);
    }
}
