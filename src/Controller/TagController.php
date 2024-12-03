<?php

namespace App\Controller;

use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\TagType;
use App\Entity\Tag;

class TagController extends AbstractController
{
    #[Route('/tag', name: 'tag')]
    public function index(TagRepository $tagRepository): Response
    {
        // dd('coucou');

        $tags = $tagRepository->findAll();
        //dd($tags);

        return $this->render('tag/index.html.twig', [
            'tags' => $tags
        ]);
    }

    #[Route(path:'/tag/create', name: 'tag_create')]
    public function createTag(Request $request, EntityManagerInterface $entityManager): Response
    {
        //on instancie un nouveau Tag
        $tag = new Tag();

        //on créé le formulaire de création de tag
        $form = $this->createForm(TagType::class, $tag);
        $formView = $form->createView();

        //on récupère ce qui se passe lors de l'exécution d'une requestion
        $form->handleRequest($request);

        if($form->isSubmitted())  {
            //dd('coucou');
            $entityManager->persist($tag);
            //dd($tag);
            $entityManager->flush();

            //si c'est bon on renvoi à la page de départ
            return $this->redirectToRoute('tag');
        }

        return $this->render('tag/create.html.twig', ['formView'=>$formView]);
    }
}
