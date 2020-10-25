<?php

namespace App\Form\Chikowa;

use App\Entity\Chikowa\Tontine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TontineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('montantParMembre', NumberType::class)
            ->add('frequencePaiement',ChoiceType::class,array(
                'choices'=>Tontine::PAYEMENT_FREQUENCE
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tontine::class,
        ]);
    }
}
