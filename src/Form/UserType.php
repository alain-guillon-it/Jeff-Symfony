<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName', TextType::class, [
                "label" => "Nom"
            ])
            ->add('firstName', TextType::class, [
                "label" => "Prénom"
            ])
            ->add('email', EmailType::class, [
                "label" => "Email"
            ])
            ->add("genre", EntityType::class, [
                "class" => Genre::class,
                "query_builder" => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('g')
                                            ->orderBy("g.label", "ASC");
                },
                "choice_label" => "label",
                "label" => "genre"
            ])
        ;

        // EntityType
        // $builder->add('users', EntityType::class, [
        //     'class' => User::class,
        //     'query_builder' => function (EntityRepository $er) {
        //         return $er->createQueryBuilder('u')
        //             ->orderBy('u.username', 'ASC');
        //     },
        //     'choice_label' => 'username',
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
