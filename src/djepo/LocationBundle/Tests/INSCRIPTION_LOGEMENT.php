<?php
class Example extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl("http://localhost/locatogo/web/app_dev.php/espace-client/location/d%C3%A9poser-une-annonce");
  }

  public function testMyTestCase()
  {
    $this->open("/locatogo/web/app_dev.php/connexion");
    $this->selectWindow("name=_e_0rz8");
    $this->click("id=u_0_1");
    $this->waitForPageToLoad("30000");
    $this->selectWindow("null");
    $this->type("id=djepo_locationbundle_logementtype_libelle", "location villa agoue");
    $this->type("id=djepo_locationbundle_logementtype_propriete_description", "location de vacance pour test");
    $this->select("id=djepo_locationbundle_logementtype_propriete_typepropriete", "label=Villa");
    $this->select("id=djepo_locationbundle_logementtype_typeImmeuble", "label=logement entier");
    $this->type("id=djepo_locationbundle_logementtype_montantloyer", "450000");
    $this->type("id=djepo_locationbundle_logementtype_propriete_proprietaire_personne_telFixe", "0987654321");
    $this->type("id=djepo_locationbundle_logementtype_propriete_proprietaire_personne_telPortable", "1234567890");
    $this->type("id=djepo_locationbundle_logementtype_propriete_adresse_numeroVoie", "20");
    $this->type("id=djepo_locationbundle_logementtype_propriete_adresse_libelleAdd", "RUE MARCEL RIVIERE");
    $this->type("id=djepo_locationbundle_logementtype_propriete_adresse_codePostal", "77400");
    $this->type("id=djepo_locationbundle_logementtype_propriete_adresse_ville_nomVille", "LAGNY SUR MARNE");
    $this->select("id=djepo_locationbundle_logementtype_propriete_adresse_ville_libelle", "label=Fidji");
    $this->type("id=djepo_locationbundle_logementtype_nombrePiece", "6");
    $this->type("id=djepo_locationbundle_logementtype_sejour", "1");
    $this->type("id=djepo_locationbundle_logementtype_cuisine", "1");
    $this->type("id=djepo_locationbundle_logementtype_chambre", "3");
    $this->type("id=djepo_locationbundle_logementtype_sbb", "1");
    $this->type("id=djepo_locationbundle_logementtype_surface", "1000");
    $this->type("id=djepo_locationbundle_logementtype_image_file1", "C:\\Users\\guy\\Desktop\\photo.htm");
    $this->type("id=djepo_locationbundle_logementtype_image_file1", "C:\\Users\\guy\\Desktop\\cssCalendrierM.jpg");
    $this->type("id=djepo_locationbundle_logementtype_image_url", "SALON");
    $this->type("id=djepo_locationbundle_logementtype_image_alt", "MON SALON");
    $this->type("id=djepo_locationbundle_logementtype_propriete_proprietaire_personne_adresse_ville_nomVille", "PARIS");
    $this->select("id=djepo_locationbundle_logementtype_propriete_proprietaire_personne_adresse_ville_libelle", "label=France");
  }
}
?>