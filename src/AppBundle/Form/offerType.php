<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class offerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('per')
            ->add('application')
            ->add('state')
            ->add('description')
            ->add('photo1')
            ->add('photo2')
            ->add('photo3')
            ->add('tag')
            ->add('category', ChoiceType::class, array(
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
