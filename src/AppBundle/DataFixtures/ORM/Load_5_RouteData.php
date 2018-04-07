<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Route;

class Load_5_RouteData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $distritFrom = $this->getReference('distrit-from');
        $distritTo = $this->getReference('distrit-to');
        $userConductor = $this->getReference('user-conductor');

        $entity = new Route();
        $entity->setCode('111');
        $entity->setSlug('route-1');
        $entity->setName('route 1');
        $entity->setNroOfSeats(5);
        $entity->setConductorId($userConductor->getId());
        $entity->setDistritFrom($distritFrom);
        $entity->setDistritTo($distritTo);
        $entity->setStatus(Route::STATUS_CREADO);
        $entity->setCreatedAt(new \Datetime());
        $entity->setTimeStart(new \Datetime());
        $entity->setTelephone('123456');
        $entity->setLatitudeStart('-12.0752286');
        $entity->setLongitudeStart('-76.9113272');
        $entity->setLatitudeEnd('-12.0752286');
        $entity->setLongitudeEnd('-76.9113272');
        $entity->setDescription('Ave. La Fontana #123, La Molina');
        $entity->setImage('https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png');
        $manager->persist($entity);

        $entity = new Route();
        $entity->setCode('222');
        $entity->setSlug('route-2');
        $entity->setName('route 2');
        $entity->setNroOfSeats(7);
        $entity->setConductorId($userConductor->getId());
        $entity->setDistritFrom($distritFrom);
        $entity->setDistritTo($distritTo);
        $entity->setStatus(Route::STATUS_CREADO);
        $entity->setCreatedAt(new \Datetime());
        $entity->setTimeStart(new \Datetime());
        $entity->setTelephone('98765454');
        $entity->setLatitudeStart('-12.0839825');
        $entity->setLongitudeStart('-76.9705258');
        $entity->setLatitudeEnd('-12.0839825');
        $entity->setLongitudeEnd('-76.9705258');
        $entity->setDescription('Ave. La Fontana #456, La Molina');
        $entity->setImage('https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png');
        $manager->persist($entity);

        $entity = new Route();
        $entity->setCode('333');
        $entity->setSlug('route-3');
        $entity->setName('route 3');
        $entity->setNroOfSeats(9);
        $entity->setConductorId($userConductor->getId());
        $entity->setDistritFrom($distritFrom);
        $entity->setDistritTo($distritTo);
        $entity->setStatus(Route::STATUS_CREADO);
        $entity->setCreatedAt(new \Datetime());
        $entity->setTimeStart(new \Datetime());
        $entity->setTelephone('76532345');
        $entity->setLatitudeStart('-12.0548184');
        $entity->setLongitudeStart('-76.964568');
        $entity->setLatitudeEnd('-12.0548184');
        $entity->setLongitudeEnd('-76.964568');
        $entity->setDescription('Ave. La Fontana #789, La Molina');
        $entity->setImage('https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png');
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }
}