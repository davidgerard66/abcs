<?php

namespace Pages\PagesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class contactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('email','email', array('label'=>'Votre e-mail'))
            ->add('nom',null,array('required'=>false,'label'=>'Nom'))
            ->add('prenom',null,array('required'=>false,'label'=>'Prénom'))
            ->add('telephone',null,array('required'=>false,'label'=>'Téléphone'))
            /*->add('Hebergement_concerne', 'entity', array(
                'class'    => 'GitesBundle:Gites',
                'property' => 'nom',
                'required' => true,
                'empty_value' => '-- Choissisez dans la liste  --',
                'label'    => 'Hébergement concerné  (Utilisez la touche control pour sélectionner plusieurs choix.)',
                'multiple' => true
            ))*/
            ->add('motif', 'choice', array(
               // 'choices' => $this->getHebergementChoices(),
                'choices' => array('Renseignement'=>'Renseignement','Rendez-vous'=>'Rendez-vous','Tout autres demandes'=>'Tout autres demandes'),

                'multiple' => true,
                'label'    => 'Le motif de votre demande  (Utilisez la touche control pour sélectionner plusieurs choix.)',
                ))
          /*  ->add('date_debut', 'date', array(
                 'label'    => 'Date début de séjour souhaitée',
            ))
            ->add('date_fin', 'date', array(
                'label'    => 'Date de fin de séjour',
            ))
          */
            ->add('contenu','textarea',array('label'=>'Votre message'))
            ->add('envoyer','submit',array('label'=>'Envoyer','attr'=> array('class'=>'btn btn-success')));
             }

    public function getName()
    {
        return 'Gites_Gitesbundle_contact';
    }
}