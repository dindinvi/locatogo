<?php
namespace djepo\UserBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

use djepo\UserBundle\Entity\Admin;

class adminHandler
{
	protected $form;
	protected $request;
	protected $em;
	protected $flash;
	protected $mailer;
	
	
	public function __construct(Form $form, Request $request, EntityManager  $em)
	{
		$this->form    = $form;
		$this->request = $request;
		$this->em      = $em;
		$this->flash = $request->getSession();
	}

	public function process()
	{
		if( $this->request->getMethod() == 'POST' )
		{
			 $this->form->bindRequest($this->request);
			if( $this->form->isValid() )	{
			     $this->onSuccess($this->form->getData());
			     return true;
		        }
                        else {
                                $this->flash->setFlash('warning', 'admin.flash.warning');
                                return false	;	
                                }	
		}

   }

	
	public function onSuccess(Admin $admin)
	{
		//en cas  d erreur le mauvais mot mail est affiche de nouveau
		$this->flash->set('user_mail',$admin->getNewMail());
		
                $this->flash->setFlash('success', 'admin.flash.success');
		
	}
}
