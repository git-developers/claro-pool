<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasajeroHasRoute
 *
 * @ORM\Table(name="pasajero_has_route", indexes={@ORM\Index(name="fk_pasajero_has_route_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_pasajero_has_route_route1_idx", columns={"route_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PasajeroHasRouteRepository")
 */
class PasajeroHasRoute
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="nro_of_seats", type="integer", nullable=true)
     */
    private $nroOfSeats;

    /**
     * @var \AppBundle\Entity\Route
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Route")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="route_id", referencedColumnName="id_increment")
     * })
     */
    private $route;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nroOfSeats
     *
     * @param integer $nroOfSeats
     *
     * @return PasajeroHasRoute
     */
    public function setNroOfSeats($nroOfSeats)
    {
        $this->nroOfSeats = $nroOfSeats;

        return $this;
    }

    /**
     * Get nroOfSeats
     *
     * @return integer
     */
    public function getNroOfSeats()
    {
        return $this->nroOfSeats;
    }

    /**
     * Set route
     *
     * @param \AppBundle\Entity\Route $route
     *
     * @return PasajeroHasRoute
     */
    public function setRoute(\AppBundle\Entity\Route $route = null)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return \AppBundle\Entity\Route
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return PasajeroHasRoute
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
