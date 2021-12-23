<?php

namespace App\Form;

use App\Entity\Stashs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StashsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adress')
            ->add('country')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Maison'=> 'house',
                    'Bumker'=>'Bumker'
                ],
            ])
            ->add('code')
            //->add('missions')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stashs::class,
        ]);
    }
}
