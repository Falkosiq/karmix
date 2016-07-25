<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class offerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Nazwa'))
            ->add('price', TextType::class, array('label' => 'Cena'))
            ->add('per', TextType::class, array('label' => 'Jednostka'))
            ->add('application', TextType::class, array('label' => 'Zastosowanie'))
            ->add('state', ChoiceType::class, array(
                'label' => 'Stan na magazynie',
                'choices' => array(
                    'dostepny' => 'Dostępny',
                    'niedostepny' => 'Niedostępny',
                    'kontakt' => 'Prosimy o kontakt',
                )
            ))
            ->add('description', TextareaType::class, array('label' => 'Opis'))
            ->add('photo1', FileType::class, array('label' => 'Zdjęcie 1', 'required' => false))
            ->add('photo2', FileType::class, array('label' => 'Zdjęcie 2', 'required' => false))
            ->add('photo3', FileType::class, array('label' => 'Zdjęcie 3', 'required' => false))
            ->add('tag')
            ->add('category', ChoiceType::class, array(
                'label' => 'Kategoria',
                'choices' => array(
                    'zboza' => 'Zboża',
                    'ryby' => 'Karmy dla ryb i zanęty',
                    'preparaty' => 'Preparaty',
                    'wyposazenie' => 'Wysposażenie rolnictwa',
                    'drob' => 'Pasze dla drobiu',
                    'wieprz' => 'Pasze dla świń',
                    'bydlo' => 'Pasze dla bydła',
                    'konie' => 'Pasze dla koni, królików i szynszyli',
                    'golebie' => 'Pasze dla gołębi',
                    'psy' => 'Pasze dla psów i kotów',
                    'ogólne' => 'Pasze do ogólnego stosowania',
                ),
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\offer'
        ));
    }
}
