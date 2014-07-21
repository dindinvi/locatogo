<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AboutControllerTest
 *
 * @author HOME
 */
namespace djepo\MainBundle\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class contactControllerTest extends WebTestCase{
    
     public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contact-location-togo');

        $this->assertTrue($crawler->filter('html:contains("Contactez-nous.")')->count() > 0);
    }
    
  public function testContact()
{
    $client = static::createClient();

    $crawler = $client->request('GET', '/contact-location-togo');

    $this->assertEquals(1, $crawler->filter('h1:contains("Contactez-nous.")')->count());

    // Sélection basée sur la valeur, l'id ou le nom des boutons
    $form = $crawler->selectButton('Submit')->form();

    $form['djepo_mainbundle_formcontacttype_nom']       = 'name';
    $form['djepo_mainbundle_formcontacttype_prenom']        = 'sodatonou'; 
     $form['djepo_mainbundle_formcontacttype_email']    = 'dindinvi@yahoo.fr';
    $form['djepo_mainbundle_formcontacttype_subject']    = 'Subject';
    $form['djepo_mainbundle_formcontacttype_message']       = 'The comment body must be at least 50 characters long as there is a validation constrain on the Enquiry entity';

        
    $crawler = $client->submit($form);

    $this->assertEquals(1, $crawler->filter('.blogger-notice:contains("Your contact enquiry was successfully sent. Thank you!")')->count());
}
    
    
}

?>

 