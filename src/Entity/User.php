<?php
// src/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tel_nr;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mobile_nr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $insertion_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Organisation")
     */
    private $organisation_id;

    /**
     * Date/Time of the last activity
     *
     * @var \Datetime
     *
     * @ORM\Column(name="last_activity_at", type="datetimetz", nullable=true)
     */
    protected $lastActivityAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $function;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="user")
     */
    private $reservationUser;

    public function __construct()
    {
        parent::__construct();
        $this->organisation_id = new ArrayCollection();
        $this->reservationUser = new ArrayCollection();
        // your own logic
    }

    public function getTelNr(): ?int
    {
        return $this->tel_nr;
    }

    public function setTelNr(?int $tel_nr): self
    {
        $this->tel_nr = $tel_nr;

        return $this;
    }

    public function getMobileNr(): ?int
    {
        return $this->mobile_nr;
    }

    public function setMobileNr(?int $mobile_nr): self
    {
        $this->mobile_nr = $mobile_nr;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getInsertionName(): ?string
    {
        return $this->insertion_name;
    }

    public function setInsertionName(?string $insertion_name): self
    {
        $this->insertion_name = $insertion_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Organisation[]
     */
    public function getOrganisationId(): Collection
    {
        return $this->organisation_id;
    }

    public function addOrganisationId(Organisation $organisationId): self
    {
        if (!$this->organisation_id->contains($organisationId)) {
            $this->organisation_id[] = $organisationId;
            $organisationId->setFunction($this);
        }

        return $this;
    }

    public function removeOrganisationId(Organisation $organisationId): self
    {
        if ($this->organisation_id->contains($organisationId)) {
            $this->organisation_id->removeElement($organisationId);
            // set the owning side to null (unless already changed)
            if ($organisationId->getFunction() === $this) {
                $organisationId->setFunction(null);
            }
        }

        return $this;
    }

    public function getLastActivityAt(): ?\DateTimeInterface
    {
        return $this->lastActivityAt;
    }
    public function setLastActivityAt(?\DateTimeInterface $lastActivityAt): self
    {
        $this->lastActivityAt = $lastActivityAt;
        return $this;
    }

    public function getFunction(): ?string
    {
        return $this->function;
    }

    public function setFunction(?string $function): self
    {
        $this->function = $function;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservationUser(): Collection
    {
        return $this->reservationUser;
    }

    public function addReservationUser(Reservation $reservationUser): self
    {
        if (!$this->reservationUser->contains($reservationUser)) {
            $this->reservationUser[] = $reservationUser;
            $reservationUser->setUser($this);
        }

        return $this;
    }

    public function removeReservationUser(Reservation $reservationUser): self
    {
        if ($this->reservationUser->contains($reservationUser)) {
            $this->reservationUser->removeElement($reservationUser);
            // set the owning side to null (unless already changed)
            if ($reservationUser->getUser() === $this) {
                $reservationUser->setUser(null);
            }
        }

        return $this;
    }
}