<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', type: TextType::class, options : [
                'label' => 'Nom du projet',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],

            ])
            ->add('description', type: TextAreaType::class)
            ->add('image', type: FileType::class)
            ->add('Enregistrer', SubmitType::class, options : [
                'attr' => ['class' => 'btn btn-success mt-3'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
