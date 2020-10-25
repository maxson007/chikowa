<?php

namespace App\Form\Chikowa;

use App\Entity\Chikowa\Association;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssociationAddMembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('membres', CollectionType::class,array(
                'entry_type'=>MembreType::class,
                'label' => false,
                'entry_options'=>['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Association::class,
        ]);
    }
}
