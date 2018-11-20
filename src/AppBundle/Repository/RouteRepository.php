<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Route;

/**
 * RouteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RouteRepository extends EntityRepository
{

    public function findAllObjects()
    {
        return $this->createQueryBuilder('a')
            ->where('a.isActive = :active')
            ->orderBy('a.idIncrement', 'DESC')
            ->setParameter('active', true)
            ;
    }

    public function findAllRoutePasajero()
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT route
            FROM AppBundle:Route route
            WHERE
            route.status = :status AND
            route.isActive = :active AND
            SUBSTRING(route.createdAt, 1, 10) = :now 
            ";

        $datetime = new \DateTime();
        $datetime = $datetime->format('Y-m-d');
	
	    $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('now', $datetime);
        $query->setParameter('status', Route::STATUS_CREADO);

        return $query->getResult();
    }


    public function findAll($limit = null, $offset = null)
    {
        return $this->findBy(['isActive' => 1], ['idIncrement' => 'DESC'], $limit, $offset);
    }

    public function findOneById($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pointOfSale
            FROM AppBundle:PointOfSale pointOfSale
            WHERE
            pointOfSale.idIncrement = :id AND
            pointOfSale.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findAllByUser($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT route
            FROM AppBundle:Route route
            WHERE
            route.conductorId = :id AND
            route.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getResult();
    }
    
    public function misCarreras($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT route
            FROM AppBundle:Route route
            WHERE
            route.conductorId = :id AND
        	route.status = :status AND
            route.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);
	    $query->setParameter('status', Route::STATUS_FINALIZADO);

        return $query->getResult();
    }
    
}
