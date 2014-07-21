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
    $this->click("//li[2]/a/b");
    $this->waitForPageToLoad("30000");
    $this->click("css=img.img-responsive");
    $this->waitForPageToLoad("30000");
    $this->click("link=Contact");
    $this->waitForPageToLoad("30000");
    $this->click("css=ol.breadcrumb > li > a");
    $this->waitForPageToLoad("30000");
    $this->click("link=Inscription");
    $this->waitForPageToLoad("30000");
    $this->click("css=img.img-responsive.pull-right");
    $this->waitForPageToLoad("30000");
    $this->click("link=Connexion");
    $this->waitForPageToLoad("30000");
    $this->click("link=Inscrivez vous");
    $this->waitForPageToLoad("30000");
  }
}
?>