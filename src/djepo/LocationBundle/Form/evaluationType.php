<?php

namespace djepo\LocationBundle\Form;

use \djepo\UserBundle\Form\Type\UserType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class evaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', new UserType)
            ->add('logement','entity', array(
                                        'class' => 'djepoLocationBundle:logement',
                                        'property' => 'libelle',
                                        'multiple' => false,
                                        'query_builder' => function(\djepo\LocationBundle\Entity\logementRepository $er) {
                                            return null;
                                        },  )) 
              
            ->add('note','text', array( 'max_length' => 2, 'label' => 'note',   'required' => true)
                    )
            ->add('commentaire','text',array('required' => false, 'label' => 'commentaire'))
            ->add('etatDuBien','text', array('required' => false))
            ->add('situation','text', array('required' => false))   
          
            
              /* 
            //->add('dateEvaluation','date')
               * ->add('user','entity', array(
                                        'class' => 'djepoUserBundle:User',
                                        'property' => 'username',
                                        'query_builder' => function(EntityRepository $er) {
                                            return null;
                                        }, ))
                */
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'djepo\LocationBundle\Entity\evaluation'
        ));
    }

    public function getName()
    {
        return 'djepo_locationbundle_evaluationtype';
    }
}
