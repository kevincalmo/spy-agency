<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Missions;
use App\Entity\Speciality;
use App\Entity\Status;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('code_name')
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'France'=> 'french',
                    'Espagne'=>'spanish'
                ],
            ])
            ->add('start_date')
            ->add('end_date')
            ->add('type', ChoiceType::class, [
                'choices'=> [
                    'Assassinat'=>'assassinat'
                ]
            ])
            ->add('agents', EntityType::class, [
                'class'=>Agents::class,
                'choice_label'=>'authentification_code',
                'multiple'=>true,
            ])
            ->add('specialitys', EntityType::class, [
                'class'=>Speciality::class,
                'choice_label'=>'name',
                'multiple'=> true,
            ])
            ->add('status', EntityType::class, [
                'class'=>Status::class,
                'choice_label'=>'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Missions::class,
        ]);
    }
}
