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
    $this->click("link=Connexion");
    $this->waitForPageToLoad("30000");
    $this->type("id=username", "kwaouvi");
    $this->type("id=password", "toto");
    $this->click("name=_submit");
    $this->waitForPageToLoad("30000");
  }
}
?>