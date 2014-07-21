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
    $this->open("/locatogo/web/app_dev.php/");
    $this->click("link=Inscription");
    $this->waitForPageToLoad("30000");
    $this->type("id=fos_user_registration_form_username", "cate");
    $this->type("id=fos_user_registration_form_plainPassword_first", "amele");
    $this->type("id=fos_user_registration_form_plainPassword_second", "amele");
    $this->select("id=fos_user_registration_form_personne_typeEntite", "label=Madame");
    $this->type("id=fos_user_registration_form_personne_lastname", "kuessan");
    $this->type("id=fos_user_registration_form_personne_firstname", "amele");
    $this->type("id=fos_user_registration_form_email_first", "amel");
    $this->type("id=fos_user_registration_form_personne_adresse_numeroVoie", "4");
    $this->type("id=fos_user_registration_form_personne_adresse_libelleAdd", "rue du berry");
    $this->type("id=fos_user_registration_form_personne_adresse_codePostal", "93330");
    $this->type("id=fos_user_registration_form_personne_adresse_ville_nomVille", "Neuilly sur marne");
    $this->select("id=fos_user_registration_form_personne_adresse_ville_libelle", "label=France");
    $this->type("id=fos_user_registration_form_captcha", "w58pd3");
    $this->type("id=fos_user_registration_form_email_first", "amele.kuessan@yahoo.fr");
    $this->type("id=fos_user_registration_form_email_second", "amele.kuessan@yahoo.fr");
    $this->click("css=input[type=\"submit\"]");
    $this->waitForPageToLoad("30000");
    $this->click("//div[@id='default-p_30345710_d06-bd']/a/em");
    $this->type("id=username", "amele.kuessan");
    $this->type("id=passwd", "CATEk0105");
    $this->click("id=.save");
    $this->click("css=#yui_3_8_1_1_1401113711101_644 > span");
    $this->waitForPageToLoad("30000");
    $this->click("css=span.subject.bold");
    $this->click("id=yui_3_16_0_1_1401113720831_1306");
    $this->click("id=yui_3_16_0_1_1401113720831_1815");
  }
}
?>