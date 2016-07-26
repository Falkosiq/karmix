<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TagType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Nazwa'))
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
                )))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tag'
        ));
    }
}
