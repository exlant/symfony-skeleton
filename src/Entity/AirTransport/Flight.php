<?php
declare(strict_types=1);

namespace App\Entity\AirTransport;

use App\Core\Traits\Entity\TCreatedAtModel;
use App\Core\Traits\Entity\TUpdatedAtModel;
use App\Core\Traits\Entity\TUuidModel;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Flight
 * @package App\Entity\AirTransport
 * @ORM\Entity(repositoryClass="App\Repository\AirTransport\FlightRepository")
 */
class Flight
{
    use TUuidModel;
    use TCreatedAtModel;
    use TUpdatedAtModel;
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255, nullable=false)
     */
    private $number;
    
    /**
     * @var Airport
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\AirTransport\Airport")
     * @ORM\JoinColumn(name="departure_airport_id", referencedColumnName="id", nullable=false)
     */
    private $departureAirport;
    
    /**
     * @var Airport
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\AirTransport\Airport")
     * @ORM\JoinColumn(name="arrival_airport_id", referencedColumnName="id", nullable=false)
     */
    private $arrivalAirport;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departure_date_time", type="datetime", nullable=false)
     */
    private $departureDateTime;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrival_date_time", type="datetime", nullable=false)
     */
    private $arrivalDateTime;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     */
    private $duration;
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getNumber(): string
    {
        return $this->number;
    }
    
    public function setNumber(string $number): self
    {
        $this->number = $number;
        
        return $this;
    }
    
    public function getDepartureDateTime(): \DateTimeInterface
    {
        return $this->departureDateTime;
    }
    
    public function setDepartureDateTime(\DateTimeInterface $departureDateTime): self
    {
        $this->departureDateTime = $departureDateTime;
        
        return $this;
    }
    
    public function getArrivalDateTime(): \DateTimeInterface
    {
        return $this->arrivalDateTime;
    }
    
    public function setArrivalDateTime(\DateTimeInterface $arrivalDateTime): self
    {
        $this->arrivalDateTime = $arrivalDateTime;
        
        return $this;
    }
    
    public function getDuration(): int
    {
        return $this->duration;
    }
    
    public function setDuration(int $duration): self
    {
        $this->duration = $duration;
        
        return $this;
    }
    
    public function getDepartureAirport(): Airport
    {
        return $this->departureAirport;
    }
    
    public function setDepartureAirport(Airport $departureAirport): self
    {
        $this->departureAirport = $departureAirport;
        
        return $this;
    }
    
    public function getArrivalAirport(): Airport
    {
        return $this->arrivalAirport;
    }
    
    public function setArrivalAirport(Airport $arrivalAirport): self
    {
        $this->arrivalAirport = $arrivalAirport;
        
        return $this;
    }
}