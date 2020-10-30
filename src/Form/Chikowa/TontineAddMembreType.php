<?php

namespace App\Form\Chikowa;

use App\Entity\Chikowa\Association;
use App\Entity\Chikowa\Inscription;
use App\Entity\Chikowa\Tontine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TontineAddMembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('inscriptions', CollectionType::class,array(
                'entry_type'=>InscriptionType::class,
                'label' => false,
                'entry_options'=>['label' => false],
                'allow_add' => true,
                'allow_delete' => true
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
