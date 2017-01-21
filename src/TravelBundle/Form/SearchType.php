<?php

namespace TravelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbRoom', NumberType::class, array('required' => true,
            'empty_data' => null,
            'label' => 'Nombre de chambre(s) à réserver',
            'attr' => array('placeholder' => 'Entrez un nombre')
                )
            )
            ->add('city', TextType::class, array('label' => 'Destination', 'attr' => array('placeholder' => 'Entrez une ville')))
            ->add('stars', ChoiceType::class, array('choices' => array('1 étoile' => 1,
                                                                       '2 étoiles' => 2,
                                                                       '3 étoiles' => 3,
                                                                       '4 étoiles' => 4,
                                                                       '5 étoiles' => 5,)),
                                                                 array('label' => 'Combien d\'étoiles?'),
                                                                 array('choice_label' => 'Combien d\'étoiles?'))
//            ->add('stars')
//            ->add('save', SubmitType::class, array('label' => 'Chercher'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
//        $resolver->setDefaults(array(
//            'data_class' => NULL
//        ));
    }

    public function getName()
    {
        return 'travel_bundle_search_type';
    }
}
