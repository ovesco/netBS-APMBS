<?php

namespace Ovesco\APMBSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="ovesco_apmbs_reservations")
 * @ORM\Entity()
 */
class Reservation {

    const TO_REVIEW = 'to review';
    const ACCEPTED = 'accepted';
    const REJECTED = 'rejected';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Cabane
     *
     * @ORM\ManyToOne(targetEntity="Ovesco\APMBSBundle\Entity\Cabane")
     * @ORM\JoinColumn(name="cabane_id", referencedColumnName="id")
     */
    protected $cabane;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    protected $status;

    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @Assert\Type("\DateTimeInterface")
     * @ORM\Column(name="start", type="datetime")
     */
    protected $start;

    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @Assert\Type("\DateTimeInterface")
     * @ORM\Column(name="end", type="datetime")
     */
    protected $end;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    protected $prenom;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="nom", type="string", length=255)
     */
    protected $nom;

    /**
     * @var string
     * @Assert\Email
     * @Assert\NotBlank()
     * @ORM\Column(name="email", type="string", length=255)
     */
    protected $email;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="phone", type="string", length=255)
     */
    protected $phone;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="unite", type="string", length=255)
     */
    protected $unite;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getStart(): \DateTime
    {
        return $this->start;
    }

    /**
     * @param \DateTime $start
     */
    public function setStart(\DateTime $start): void
    {
        $this->start = $start;
    }

    /**
     * @return \DateTime
     */
    public function getEnd(): \DateTime
    {
        return $this->end;
    }

    /**
     * @param \DateTime $end
     */
    public function setEnd(\DateTime $end): void
    {
        $this->end = $end;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getUnite(): string
    {
        return $this->unite;
    }

    /**
     * @param string $unite
     */
    public function setUnite(string $unite): void
    {
        $this->unite = $unite;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Cabane
     */
    public function getCabane(): Cabane
    {
        return $this->cabane;
    }

    /**
     * @param Cabane $cabane
     */
    public function setCabane(Cabane $cabane): void
    {
        $this->cabane = $cabane;
    }
}