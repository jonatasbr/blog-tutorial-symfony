<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null, Array (
                'label' => 'Nome',
                'attr' => ['class' => 'form-control'],
            ))
            ->add('description',null, Array (
                'label' => 'Descrição',
                'attr' => ['class' => 'form-control'],
            ))
            ->add('slug',null, Array (
                'label' => 'Slug',
                'attr' => ['class' => 'form-control'],
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
