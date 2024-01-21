<?php

namespace App\Form\Type;

use App\Entity\RegistrationUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'constraints' => new NotBlank(),
            ])
            ->add('password', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 6,
                        'max' => 16,
                        'minMessage' => 'Your password must be at least 6 characters long',
                        'maxMessage' => 'Your password cannot be longer than 16 characters',
                    ]),
                    new Regex([
                        'pattern' => '/\d+/',
                        'match' => true,
                        'message' => 'Your password must have at least one number']),
                    new Regex([
                        'pattern' => '/[A-Z]+/',
                        'match' => true,
                        'message' => 'Your password must have at least one uppercase letter']),
                    new Regex([
                        'pattern' => '/[a-z]+/',
                        'match' => true,
                        'message' => 'Your password must have at least one lowercase letter']),
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9!?]+$/',
                        'match' => true,
                        'message' => 'You are entering invalid symbols']),
                ],
            ])
            ->add('save', SubmitType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RegistrationUser::class,
        ]);
    }
}
