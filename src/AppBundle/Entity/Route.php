<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSS;

/**
 * Route
 *
 * @ORM\Table(name="route",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="code_UNIQUE", columns={"code"})
 *     },
 *     indexes={@ORM\Index(name="fk_route_route1_idx", columns={"route_id"})
 * })
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RouteRepository")
 */
class Route
{

    const STATUS_CREADO = 'CREADO';
    const STATUS_ANULADO = 'ANULADO';
    const STATUS_EN_CURSO = 'EN_CURSO';
    const STATUS_FINALIZADO = 'FINALIZADO';

    const STATUS_PASAJERO_DISPONIBLE = 'DISPONIBLE';
    const STATUS_PASAJERO_SOLICITADO = 'SOLICITADO';
    const STATUS_PASAJERO_ANULADO = 'ANULADO';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"route"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=45, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100, nullable=false)
     * @JMSS\Groups({"route"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude_start", type="decimal", precision=11, scale=8, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $latitudeStart;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude_start", type="decimal", precision=11, scale=8, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $longitudeStart;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude_end", type="decimal", precision=11, scale=8, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $latitudeEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude_end", type="decimal", precision=11, scale=8, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $longitudeEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="nro_of_seats", type="string", length=11, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $nroOfSeats;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="text", length=45, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_por_hora", type="text", length=45, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $precioPorHora;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", length=65535, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     * @JMSS\Groups({"route"})
     */
    private $createdAt;


    /**
     * @var \Time
     *
     * @ORM\Column(name="time_start", type="time", nullable=true)
     * @JMSS\Type("DateTime<'H:i'>")
     * @JMSS\Groups({"route"})
     */
    private $timeStart;

    /**
     * @var \Time
     *
     * @ORM\Column(name="time_end", type="time", nullable=true)
     * @JMSS\Type("DateTime<'H:i'>")
     * @JMSS\Groups({"route"})
     */
    private $timeEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive = '1';

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", mappedBy="route")
     */
    private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="conductor_id", type="string", length=11, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $conductorId;

    /**
     * @var \AppBundle\Entity\Distrit
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Distrit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distrit_from", referencedColumnName="id")
     * })
     *
     * @JMSS\Groups({"route"})
     */
    private $distritFrom;

    /**
     * @var \AppBundle\Entity\Distrit
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Distrit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distrit_to", referencedColumnName="id")
     * })
     *
     * @JMSS\Groups({"route"})
     */
    private $distritTo;

    /**
     * @var string
     *
     * @ORM\Column(name="status_pasajero", type="string", length=45, nullable=true)
     * @JMSS\Groups({"route"})
     */
    private $statusPasajero;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return sprintf('%s - %s', $this->idIncrement, $this->name);
    }

    /**
     * Get idIncrement
     *
     * @return integer
     */
    public function getIdIncrement()
    {
        return $this->idIncrement;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatusPasajero()
    {
        return $this->statusPasajero;
    }

    /**
     * @param string $statusPasajero
     */
    public function setStatusPasajero($statusPasajero)
    {
        $this->statusPasajero = $statusPasajero;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return PointOfSale
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return PointOfSale
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return PointOfSale
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return PointOfSale
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PointOfSale
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return PointOfSale
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return PointOfSale
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set route
     *
     * @param \AppBundle\Entity\Route $route
     *
     * @return Route
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
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return PointOfSale
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getConductorId()
    {
        return $this->conductorId;
    }

    /**
     * @param int $conductorId
     */
    public function setConductorId($conductorId)
    {
        $this->conductorId = $conductorId;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getPrecioPorHora()
    {
        return $this->precioPorHora;
    }

    /**
     * @param string $precioPorHora
     */
    public function setPrecioPorHora($precioPorHora)
    {
        $this->precioPorHora = $precioPorHora;
    }

    /**
     * @return string
     */
    public function getLatitudeStart()
    {
        return $this->latitudeStart;
    }

    /**
     * @param string $latitudeStart
     */
    public function setLatitudeStart($latitudeStart)
    {
        $this->latitudeStart = $latitudeStart;
    }

    /**
     * @return string
     */
    public function getLongitudeStart()
    {
        return $this->longitudeStart;
    }

    /**
     * @param string $longitudeStart
     */
    public function setLongitudeStart($longitudeStart)
    {
        $this->longitudeStart = $longitudeStart;
    }

    /**
     * @return string
     */
    public function getLatitudeEnd()
    {
        return $this->latitudeEnd;
    }

    /**
     * @param string $latitudeEnd
     */
    public function setLatitudeEnd($latitudeEnd)
    {
        $this->latitudeEnd = $latitudeEnd;
    }

    /**
     * @return string
     */
    public function getLongitudeEnd()
    {
        return $this->longitudeEnd;
    }

    /**
     * @param string $longitudeEnd
     */
    public function setLongitudeEnd($longitudeEnd)
    {
        $this->longitudeEnd = $longitudeEnd;
    }

    /**
     * @return int
     */
    public function getNroOfSeats()
    {
        return $this->nroOfSeats;
    }

    /**
     * @param int $nroOfSeats
     */
    public function setNroOfSeats($nroOfSeats)
    {
        $this->nroOfSeats = $nroOfSeats;
    }

    /**
     * @return \Time
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * @param \Time $timeStart
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;
    }

    /**
     * @return \Time
     */
    public function getTimeEnd()
    {
        return $this->timeEnd;
    }

    /**
     * @param \Time $timeEnd
     */
    public function setTimeEnd($timeEnd)
    {
        $this->timeEnd = $timeEnd;
    }

    /**
     * @return Distrit
     */
    public function getDistritFrom()
    {
        return $this->distritFrom;
    }

    /**
     * @param Distrit $distritFrom
     */
    public function setDistritFrom($distritFrom)
    {
        $this->distritFrom = $distritFrom;
    }

    /**
     * @return Distrit
     */
    public function getDistritTo()
    {
        return $this->distritTo;
    }

    /**
     * @param Distrit $distritTo
     */
    public function setDistritTo($distritTo)
    {
        $this->distritTo = $distritTo;
    }
}
