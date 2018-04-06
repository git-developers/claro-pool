<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Role;

class Load_1_RoleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {


        /**
         * ROLE_CLARO_POOL
         */
        $entity = new Role();
        $entity->setName('claro_conductor');
        $entity->setSlug(Role::ROLE_CONDUCTOR);
        $entity->setGroupRol('claro_conductor');
        $entity->setGroupRolTag('group-claro-rol');
        $manager->persist($entity);
        $this->addReference('role-claro-conductor', $entity);

        $entity = new Role();
        $entity->setName('claro_pasajero');
        $entity->setSlug(Role::ROLE_PASAJERO);
        $entity->setGroupRol('claro_pasajero');
        $entity->setGroupRolTag('group-claro-rol');
        $manager->persist($entity);
        $this->addReference('role-claro-pasajero', $entity);



        /**
         * ROLE_ADMIN
         */
        $entity = new Role();
        $entity->setName('backend');
        $entity->setSlug('ROLE_ADMIN');
        $entity->setGroupRol('backend');
        $entity->setGroupRolTag('group-backend');
        $manager->persist($entity);
        $this->addReference('role-backend', $entity);

        /**
         * USER
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_USER_CREATE');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-create-user', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_USER_EDIT');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-edit-user', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_USER_DELETE');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-delete-user', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_USER_VIEW');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-view-user', $entity);

        $entity = new Role();
        $entity->setName('changepassword');
        $entity->setSlug('ROLE_USER_CHANGEPASSWORD');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-changepassword-user', $entity);


        /**
         * ROUTES
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_ROUTE_CREATE');
        $entity->setGroupRol('route');
        $entity->setGroupRolTag('group-route');
        $manager->persist($entity);
        $this->addReference('role-create-route', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_ROUTE_EDIT');
        $entity->setGroupRol('route');
        $entity->setGroupRolTag('group-route');
        $manager->persist($entity);
        $this->addReference('role-edit-route', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_ROUTE_DELETE');
        $entity->setGroupRol('route');
        $entity->setGroupRolTag('group-route');
        $manager->persist($entity);
        $this->addReference('role-delete-route', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_ROUTE_VIEW');
        $entity->setGroupRol('route');
        $entity->setGroupRolTag('group-route');
        $manager->persist($entity);
        $this->addReference('role-view-route', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('route');
        $entity->setGroupRolTag('group-route');
        $manager->persist($entity);



        /**
         * ACLROLE
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_ACLROLE_CREATE');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);
        $this->addReference('role-create-aclrole', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_ACLROLE_EDIT');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);
        $this->addReference('role-edit-aclrole', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_ACLROLE_DELETE');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);
        $this->addReference('role-delete-aclrole', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_ACLROLE_VIEW');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);
        $this->addReference('role-view-aclrole', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);



        /**
         * ACLPROFILE
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_ACLPROFILE_CREATE');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);
        $this->addReference('role-create-aclprofile', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_ACLPROFILE_EDIT');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);
        $this->addReference('role-edit-aclprofile', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_ACLPROFILE_DELETE');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);
        $this->addReference('role-delete-aclprofile', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_ACLPROFILE_VIEW');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);
        $this->addReference('role-view-aclprofile', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}