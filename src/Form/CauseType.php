<?php

namespace App\Form;

use App\Entity\Cause;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CauseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'titre',
                'required' => false,
                'help' => 'Saisir ule titre de la cause entre 4 et 25 caractères',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir le titre de la cause'
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Veuillez saisir un titre d\'au moins 4 caractères',
                        'max' => 25,
                        'maxMessage' => 'Veuillez saisir un titre de moins de 25 caractères'
                    ])
                ]
            ])
            ->add('img')
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cause::class,
        ]);
    }
}
