<?php

declare(strict_types=1);

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@guikprod.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Form\Type\Security;

use App\Domain\DTO\Security\Interfaces\RegistrationDTOInterface;
use App\Domain\DTO\Security\RegistrationDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RegistrationType.
 *
 * @package App\UI\Form\Type\Security
 */
final class RegistrationType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'minLength' => 2,
                    'maxLength' => 25
                ],
                'help' => 'registration.username_help'
            ])
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('profileImage', FileType::class, [
                'required' => false
            ])
        ;
    }

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegistrationDTOInterface::class,
            'empty_data' => function (FormInterface $form) {
                return new RegistrationDTO(
                    $form->get('username')->getData(),
                    $form->get('email')->getData(),
                    $form->get('password')->getData(),
                    $form->get('profileImage')->getData()
                );
            },
            'validation_groups' => ['RegistrationDTO']
        ]);
    }
}
