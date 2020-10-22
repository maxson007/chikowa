<?php

namespace App\Form\Chikowa;

use App\Entity\Chikowa\Association;
use App\OpenStreetMap\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssociationType extends AbstractType
{
    /**
     * @var Client
     */
    private $streetMapClient;

    /**
     * AssociationType constructor.
     * @param Client $streetMapClient
     */
    public function __construct(Client $streetMapClient)
    {
        $this->streetMapClient = $streetMapClient;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('typeEntite',ChoiceType::class, [
                "choices"=> array_flip(Association::ASSOCIATION_TYPE_VALUES)
            ])
            ->add('ville');
            //->add('pays', CountryType::class);

        $formModifier = function (FormInterface $form, $localisation= null) {
            $places = null === $localisation ? [] : $this->streetMapClient->fetchDataByCity($localisation);
            $form->add('localisation', ChoiceType::class, [
                'choices' => $places,
                'choice_value' => 'placeId',
                'choice_label' => function($place) {
                    return $place ;
                }
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                /** @var Association $association */
                $association = $event->getData();

                $formModifier($event->getForm(), $association->getLocalisation()??"ouani");
            }
        );
        $builder->get('ville')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $localisation = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $localisation??"ouani");
            }
        );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Association::class,
        ]);
    }
}
