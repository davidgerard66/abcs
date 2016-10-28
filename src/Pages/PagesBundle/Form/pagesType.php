<?php

namespace Pages\PagesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class pagesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('actif',null, array('label' =>'ce contenu est actif '))
            ->add('titre')
            ->add('grandtitre')
            ->add('genre', 'choice', array(
                'choices'  => array(
                    'Page' => 'Page',
                    'Entete' => 'Entete',
                    'Slide' => 'Slide',

                ),
                // *this line is important*
                'choices_as_values' => true,
                'expanded'=>true
            ))
            ->add('langue', 'choice', array(
                'choices'  => array(
                    'FR' => 'FR',
                    'ES' => 'ES',
                                    ),
                // *this line is important*
                'choices_as_values' => true,
                'expanded'=>true
            ))
            ->add('showSlides',null, array('label' =>'afficher les slides sur cette page ?  '))
            ->add('ordre')
            ->add('contenu',null,array('attr'=> array('class'=>'ckeditor')))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pages\PagesBundle\Entity\Pages'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pages_pagesbundle_pages';
    }
}
