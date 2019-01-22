<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, Array (
                'label' => 'Título',
                'attr' => ['class' => 'form-control'],
            ))
            ->add('description', null, Array (
                'label' => 'Descrição',
                'attr' => ['class' => 'form-control'],

            ))
            ->add('content',null, Array (
                'label' => 'Conteúdo',
                'attr' => ['class' => 'form-control'],

            ))
            ->add('slug',null, Array (
                'label' => 'Slug',
                'attr' => ['class' => 'form-control'],

            ))
            ->add('status',null, Array (
                'label' => 'Status',
                'attr' => ['class' => 'form-control'],

            ))
            ->add('categories',null, Array (
                'label' => 'Categorias',
                'attr' => ['class' => 'form-control'],

            ))
            ->add('author',null, Array (
                'label' => 'Autor',
                'attr' => ['class' => 'form-control'],

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' =>Post::class
        ]);
    }
}
