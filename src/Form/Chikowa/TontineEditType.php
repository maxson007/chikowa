<?php

namespace App\Form\Chikowa;

use App\Entity\Chikowa\Tontine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TontineEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('montantParMembre', MoneyType::class)
            ->add('dateDebut', DateType::class,array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr'=>[ 'desabled'=>true, 'readonly'=>true]
            ))
            ->add('tontineType',ChoiceType::class,array(
                'choices'=>Tontine::TYPE_TONTINE
            ))
            ->add('frequencePaiement',ChoiceType::class,array(
                'choices'=>Tontine::PAYEMENT_FREQUENCE
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'validation_groups' => ['edit'],
            'data_class' => Tontine::class,
        ]);
    }
}
