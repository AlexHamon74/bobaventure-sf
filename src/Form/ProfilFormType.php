<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfilFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
                'empty_data' => '',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre prénom.',
                    ]),
                ],
                
            ])

            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'empty_data' => '',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre nom.',
                    ]),
                ],
            ])

            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
                'empty_data' => '',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse email.',
                    ]),
                    new Email([
                        'message' => 'Veuillez entrer une adresse email valide.',
                    ]),
                ],
            ])

            ->add('phone_number', TelType::class, [
                'label' => 'Téléphone',
                'required' => false,
            ])

            ->add('adress', TextType::class, [
                'label' => 'Adresse',
                'required' => false,
            ])

            ->add('description', TextareaType::class, [
                'label' => 'Bio',
                'required' => false,
                'attr' => [
                    'rows' => 4,
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer les modifications&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-floppy-disk"></i>',
                'label_html' => true,
                'attr' => [
                    'class' => 'submit-button w-100',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => [
                'class' => 'row',
            ],
        ]);
    }
}
