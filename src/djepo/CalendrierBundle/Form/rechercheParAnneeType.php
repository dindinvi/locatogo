<?php

namespace djepo\CalendrierBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class rechercheParAnneeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
               ->add('annee', 'date', array(
                                        'widget' => 'choice',
                                        'format' => 'yyyy-MM-dd',
                        ));
        
    }

   /*  public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\CalendrierBundle\Entity\rechercheParAnnee'
        ));
    }
    * */
    
    
    public function getName()
    {
        return 'acteurrecherche';
    }
}
