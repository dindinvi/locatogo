<?php

namespace djepo\UserBundle\Form\Type;
use djepo\UserBundle\Form\PersonneType;

use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
//use Symfony\Component\Form\FormBuilder; 
use Symfony\Component\Form\FormBuilderInterface;
  
 
class ProfileUserType extends BaseType
{
   protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildUserForm($builder, $options);

        // add your custom field
        $builder
                   //->remove('username')
                    ->remove('email')
                   ->add('personne', new PersonneType)
         ;
    }

    public function getName() {
      return 'fos_user_profile';
}
/* MODIFICATION POUR SUPPRIMER LA FONCTION DE VERIFICATION PAR MOT DE PASSE
 * DANS buildForm A CAUSE DE FACEBOOK
 */
  public function buildForm(FormBuilderInterface $builder, array $options)
    {
             $this->buildUserForm($builder, $options);
    }

    
}
