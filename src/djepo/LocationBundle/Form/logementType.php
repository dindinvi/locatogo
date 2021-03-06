<?php

namespace djepo\LocationBundle\Form;

use djepo\LocationBundle\Form\Type\typeLogementType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class logementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('propriete', new proprieteType)
            ->add('montantloyer','text', array( 'max_length' => 6,  'label' => 'montant loyer', 'required' => true) )   
            ->add('libelle','text', array('required' => true, 'label' => 'titre '))
            ->add('nombrePiece','text',   array( 'max_length' => 2,  'label' => 'Nombre de pieces', 'required' => true) )
            ->add('typeImmeuble', new typeLogementType(), array( 'empty_value' => 'Choisir...', 'required'  => true, 'label' => 'type de bien', )  )
            ->add('surface','text', array( 'max_length' => 4, 'label' => 'surface',  'required' => true)  )
            ->add('sejour','text',   array( 'max_length' => 2, 'label' => 'Nombre de sejour',   'required' => true) )
            ->add('sbb','text',  array( 'max_length' => 2,  'label' => 'Nombre de salle de bain',   'required' => true)  )
            ->add('chambre','text',   array( 'max_length' => 2,  'label' => 'Nombre de chambre',  'required' => true) )
            ->add('cuisine','text',  array( 'max_length' => 2, 'label' => 'Nombre de cuisine',  'required' => true)  )
            ->add('image', new imageType)
           
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\LocationBundle\Entity\logement'
        ));
    }

    public function getName()
    {
        return 'djepo_locationbundle_logementtype';
    }
}
