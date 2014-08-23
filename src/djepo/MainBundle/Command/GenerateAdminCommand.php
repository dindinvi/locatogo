<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GenerateAdminCommand
 *
 * @author guy
 */
namespace djepo\MainBundle\Command;
 
use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCrudCommand;
use Sensio\Bundle\GeneratorBundle\Generator\DoctrineCrudGenerator;
 
class GenerateAdminCommand extends GenerateDoctrineCrudCommand
{
    protected function configure()
    {
        parent::configure();
        $this->setName('djepo:generate:admin');
        $this->setDescription('Admin generator');
    }
    protected function getGenerator() {
	$generator = new DoctrineCrudGenerator($this->getContainer()->get('filesystem'), __DIR__.'/../Resources/skeleton/crud');
	$this->setGenerator($generator);
	return parent::getGenerator();
}
   /* protected function getGenerator()
    {
        if (null === $this->generator)
        {
            $this->generator = new DoctrineCrudGenerator($this->getContainer()->get('filesystem'), __DIR__.'/../Resources/skeleton/crud');
        }
 
        return $this->generator;
    }
    */
}

/*namespace MesBundles\TwigCrudBundle\Command;
use Sensio\Bundle\GeneratorBundle\Generator\DoctrineCrudGenerator;
use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCrudCommand;

class DoctrineGenerateCrudTwitterBootstrapCommand extends GenerateDoctrineCrudCommand
{

protected function configure()
{
	parent::configure();
	$this->setName('doctrine:generate:crud:twitter-bootstrap');
}

protected function getGenerator() {
	$generator = new DoctrineCrudGenerator($this->getContainer()->get('filesystem'), __DIR__.'/../Resources/skeleton/crud');
	$this->setGenerator($generator);
	return parent::getGenerator();
}

}
 * */
 