<?php

namespace App\Form\Chikowa;

use App\Entity\Chikowa\Tontine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TontineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('montantParMembre')
            ->add('frequencePaiement')
            ->add('organisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tontine::class,
        ]);
    }
}
