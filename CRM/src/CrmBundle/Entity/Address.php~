<?php

namespace CrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="Address")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\AddressRepository")
 */
class Address {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=100)
     */
    private $street;

    /**
     * @var int
     *
     * @ORM\Column(name="blockNo", type="integer")
     */
    private $blockNo;

    /**
     * @var int
     *
     * @ORM\Column(name="appartNo", type="integer")
     */
    private $appartNo;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="addresses")
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
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city) {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street) {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * Set blockNo
     *
     * @param integer $blockNo
     * @return Address
     */
    public function setBlockNo($blockNo) {
        $this->blockNo = $blockNo;

        return $this;
    }

    /**
     * Get blockNo
     *
     * @return integer
     */
    public function getBlockNo() {
        return $this->blockNo;
    }

    /**
     * Set appartNo
     *
     * @param integer $appartNo
     * @return Address
     */
    public function setAppartNo($appartNo) {
        $this->appartNo = $appartNo;

        return $this;
    }

    /**
     * Get appartNo
     *
     * @return integer
     */
    public function getAppartNo() {
        return $this->appartNo;
    }

    /**
     * Set person
     *
     * @param \CrmBundle\Entity\Person $person
     * @return Address
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

    public function __toString() {
        return $this->street;
    }

}
