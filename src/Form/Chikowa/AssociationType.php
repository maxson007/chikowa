<?php

namespace App\Form\Chikowa;

use App\Entity\Chikowa\Association;
use App\Form\Type\Select2Type;
use App\OpenStreetMap\Client;
use phpDocumentor\Reflection\Types\String_;
use SebastianBergmann\CodeCoverage\Report\Text;
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
        $data = $builder->getData();

        $builder
            ->add('libelle')
            ->add('typeEntite',ChoiceType::class, [
                "choices"=> array_flip(Association::ASSOCIATION_TYPE_VALUES)
            ])
            ->add('localisation',Select2Type::class, array(
                'required' => true,
                'choices' => [$data->getLocalisation() => $data->getId()]
            ));
            //->add('pays', CountryType::class);

        $formModifier = function (FormInterface $form, ?string $localisation ) {
            $choices = empty($localisation) ? null : [$localisation => $localisation];
            $form->add('localisation', Select2Type::class, [
                'required' => true,
                'choices' => $choices,
                'data' => $localisation
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();
                $formModifier($event->getForm(), empty($data['localisation']) ? 0 : $data['localisation']);
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
