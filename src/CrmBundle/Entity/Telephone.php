<?php

namespace CrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Telephone
 *
 * @ORM\Table(name="Telephone")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\TelephoneRepository")
 */
class Telephone {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bigint
     *
     * @ORM\Column(name="telNo", type="bigint")
     */
    private $telNo;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="telephones")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    private $person;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set telNo
     *
     * @param integer $telNo
     * @return Telephone
     */
    public function setTelNo($telNo) {
        $this->telNo = $telNo;

        return $this;
    }

    /**
     * Get telNo
     *
     * @return integer
     */
    public function getTelNo() {
        return $this->telNo;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Telephone
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set person
     *
     * @param \CrmBundle\Entity\Person $person
     * @return Telephone
     */
    public function setPerson(\CrmBundle\Entity\Person $person = null) {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \CrmBundle\Entity\Person
     */
    public function getPerson() {
        return $this->person;
    }
}
