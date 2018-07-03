<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $accommodation;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Guest", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $guest;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="date")
     */
    private $arrivalDate;

    /**
     * @ORM\Column(type="date")
     */
    private $departureDate;

    public function getId()
    {
        return $this->id;
    }

    public function getAccommodation(): ?string
    {
        return $this->accommodation;
    }

    public function setAccommodation(?string $accommodation): self
    {
        $this->accommodation = $accommodation;

        return $this;
    }

    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    public function setGuest(Guest $guest): self
    {
        $this->guest = $guest;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getArrivalDate(): ?DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(DateTimeInterface $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getDepartureDate(): ?DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }
}
