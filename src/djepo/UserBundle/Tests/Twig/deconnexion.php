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
    $this->click("link=Déconnexion");
    $this->waitForPageToLoad("30000");
  }
}
?>