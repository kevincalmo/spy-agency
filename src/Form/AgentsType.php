<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Speciality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('last_name')
            ->add('first_name')
            ->add('birth_date')
            ->add('authentification_code')
            ->add('nationality', ChoiceType::class, [
                'choices' => [
                    'France'=> 'french',
                    'Espagne'=>'spanish'
                ],
            ])
            ->add('password')
            ->add('specialitys', EntityType::class, [
                'class'=>Speciality::class,
                'choice_label'=>'name',
                'multiple'=> true,
            ])
            /* ->add('mission') */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agents::class,
        ]);
    }
}
