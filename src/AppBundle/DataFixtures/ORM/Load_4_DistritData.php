<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Distrit;

class Load_4_DistritData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $entity = new Distrit();
        $entity->setName('La victoria');
        $manager->persist($entity);
        $this->addReference('distrit-from', $entity);

        $entity = new Distrit();
        $entity->setName('La molina');
        $manager->persist($entity);
        $this->addReference('distrit-to', $entity);

        $entity = new Distrit();
        $entity->setName('Comas');
        $manager->persist($entity);

        $entity = new Distrit();
        $entity->setName('Pueblo Libre');
        $manager->persist($entity);

        $entity = new Distrit();
        $entity->setName('Lince');
        $manager->persist($entity);

        $entity = new Distrit();
        $entity->setName('San Isidro');
        $manager->persist($entity);

        $entity = new Distrit();
        $entity->setName('San Luis');
        $manager->persist($entity);

        $entity = new Distrit();
        $entity->setName('Surquillo');
        $manager->persist($entity);

        $entity = new Distrit();
        $entity->setName('Miraflores');
        $manager->persist($entity);

        $entity = new Distrit();
        $entity->setName('Rimac');
        $manager->persist($entity);

        $entity = new Distrit();
        $entity->setName('El Agustino');
        $manager->persist($entity);

        $entity = new Distrit();
        $entity->setName('Puente Piedra');
        $manager->persist($entity);

        $entity = new Distrit();
        $entity->setName('Ventanilla');
        $manager->persist($entity);

        $entity = new Distrit();
        $entity->setName('Villa el salvador');
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 4;
    }
}