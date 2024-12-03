<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\TagType;

class TagController extends AbstractController
{
    #[Route('/tag', name: 'tag')]
    public function index(): Response
    {
        // dd('coucou');

        return $this->render('tag/index.html.twig', [
            'controller_name' => 'TagController',
        ]);
    }

    #[Route(path:'/tag/create', name: 'tag_create')]
    public function createTag()
    {
        $form = $this->createForm(TagType::class);
        $formView = $form->createView();

        return $this->render('tag/create.html.twig', ['formView'=>$formView]);
    }
}
