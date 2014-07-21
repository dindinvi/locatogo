<?php
class Example extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl("http://localhost:81/locatogo/web/app_dev.php");
  }

  public function testMyTestCase()
  {
    $this->open("/locatogo/web/app_dev.php");
    $this->click("//li[3]/a/b");
    $this->waitForPageToLoad("30000");
    $this->type("id=djepo_mainbundle_formcontacttype_nom", "dindinv");
    $this->type("id=djepo_mainbundle_formcontacttype_prenom", "sodatonou");
    $this->type("id=djepo_mainbundle_formcontacttype_email", "kwaouvi.g@gmail.com");
    $this->type("id=djepo_mainbundle_formcontacttype_subject", "demande de renseignement");
    $this->type("id=djepo_mainbundle_formcontacttype_message", "test pour la création de données de test. cordialement");
    $this->type("id=djepo_mainbundle_formcontacttype_captcha", "7yebra");
    $this->click("name=_submit");
    $this->waitForPageToLoad("30000");
    $this->click("link=Par téléphone");
  }
}
?>