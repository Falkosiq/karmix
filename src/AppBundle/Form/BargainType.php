<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BargainType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Nazwa'))
            ->add('text', TextareaType::class, array('label' => 'Tekst'))
            ->add('photo', FileType::class, array('label' => 'Obraz'))
            ->add('link', EntityType::class, array(
                'class'=>'AppBundle:offer',
                'placeholder'=>'Wybierz ofertę, której dotyczy promocja',
                'choice_label'=> function($offer) {
                    return $offer->getName();
                },    
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Bargain'
        ));
    }
}
