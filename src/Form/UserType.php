<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, Array (
                'label' => 'Nome',
                'attr' => ['class' => 'form-control'],
            ))
            ->add('lastName', null, Array (
                'label' => 'Sobrenome',
                'attr' => ['class' => 'form-control'],
            ))
            ->add('email', null, Array (
                'label' => 'E-mail',
                'attr' => ['class' => 'form-control'],
            ))
            ->add('username', null, Array (
                'label' => 'Usuário',
                'attr' => ['class' => 'form-control'],
            ))
            ->add('password', RepeatedType::class, Array (
                'type' => PasswordType::class,
                'first_options'  => Array (
                    'label' => 'Senha',
                    'attr' => ['class' => 'form-control']
                ),
                'second_options' => Array (
                    'label' => 'Confirmar Senha',
                    'attr' => ['class' => 'form-control']
                ),
                'attr' => ['class' => 'form-control'],
            ))
            ->add('roles', ChoiceType::class, Array (
                'label' => 'Permissões',
                'attr' => ['class' => 'form-control'],
                'multiple' => true,
                'choices' => [
                    'Usuário' => 'ROLE_USER',
                    'Post' => 'ROLE_POST',
                    'Categoria' => 'ROLE_CATEGORIA',
                ]

            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
