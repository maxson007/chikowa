<?php

namespace App\Form\Chikowa;

use App\Entity\Chikowa\Inscription;
use App\Entity\Chikowa\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tontine', null,[
                'attr'=>['class'=>'d-none']
            ])
            ->add('positionRecuperation', IntegerType::class)
            ->add('membre',MembreType::class,
                [
                    'data_class' => Membre::class,
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
