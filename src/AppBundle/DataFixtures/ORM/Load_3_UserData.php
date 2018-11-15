<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class Load_3_UserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
//        $client1 = $this->getReference('client-1');
//        $client2 = $this->getReference('client-2');

        $profileAdmin = $this->getReference('profile-admin');
        $profileConductor = $this->getReference('profile-conductor');
        $profilePasajero = $this->getReference('profile-pasajero');

        $entity = new User();
//        $entity->setClient($client1);
        $entity->setDni('12345678');
        $entity->setCode('Z1234');
        $entity->setPassword('123');
        $entity->setName('Alan');
        $entity->setLastName('Garcia');
        $entity->setImage('https://medizzy.com/_nuxt/img/user-placeholder.d2a3ff8.png');
        $entity->setEmail('admin@gmail.com');
        $entity->setIsActive(true);
        $entity->setProfile($profileAdmin);
        $manager->persist($entity);

        $entity = new User();
//        $entity->setClient($client2);
        $entity->setCode('V6655');
        $entity->setDni('88889999');
        $entity->setPassword('123');
        $entity->setName('Steve');
        $entity->setLastName('Jobs');
        $entity->setImage('https://medizzy.com/_nuxt/img/user-placeholder.d2a3ff8.png');
        $entity->setEmail('test@gmail.com');
        $entity->setIsActive(true);
        $entity->setProfile($profileConductor);
        $manager->persist($entity);

        $entity = new User();
//        $entity->setClient($client1);
        $entity->setCode('X5577');
        $entity->setDni('87654321');
        $entity->setPassword('123');
        $entity->setName('Albert');
        $entity->setLastName('Einstein');
        $entity->setImage('https://medizzy.com/_nuxt/img/user-placeholder.d2a3ff8.png');
        $entity->setEmail('aeinstein@gmail.com');
        $entity->setIsActive(true);
        $entity->setProfile($profilePasajero);
        $manager->persist($entity);

        $entity = new User();
//        $entity->setClient($client2);
        $entity->setCode('B9988');
        $entity->setDni('22334455');
        $entity->setPassword('123');
        $entity->setName('Bill');
        $entity->setLastName('Gates');
        $entity->setImage('https://medizzy.com/_nuxt/img/user-placeholder.d2a3ff8.png');
        $entity->setEmail('bgates@gmail.com');
        $entity->setIsActive(true);
        $manager->persist($entity);

        $entity = new User();
//        $entity->setClient($client2);
        $entity->setCode('W3344');
        $entity->setDni('99887766');
        $entity->setPassword('123');
        $entity->setName('Isaac');
        $entity->setLastName('Newton');
        $entity->setImage('https://medizzy.com/_nuxt/img/user-placeholder.d2a3ff8.png');
        $entity->setEmail('inewton@gmail.com');
        $entity->setIsActive(true);
        $entity->setProfile($profileConductor);
        $manager->persist($entity);
        $this->addReference('user-conductor', $entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}