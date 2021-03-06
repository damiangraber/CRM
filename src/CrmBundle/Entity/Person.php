<?php

namespace CrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="Person")
 * @ORM\Entity(repositoryClass="CrmBundle\Repository\PersonRepository")
 */
class Person {

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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=50)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="person", cascade={"remove"})
     */
    private $addresses;

    /**
     * @ORM\OneToMany(targetEntity="Email", mappedBy="person")
     */
    private $emails;

    /**
     * @ORM\OneToMany(targetEntity="Telephone", mappedBy="person")
     */
    private $telephones;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Person
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Person
     */
    public function setSurname($surname) {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname() {
        return $this->surname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Person
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->emails = new \Doctrine\Common\Collections\ArrayCollection();
        $this->telephones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add addresses
     *
     * @param \CrmBundle\Entity\Address $addresses
     * @return Person
     */
    public function addAddress(\CrmBundle\Entity\Address $addresses) {
        $this->addresses[] = $addresses;

        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \CrmBundle\Entity\Address $addresses
     */
    public function removeAddress(\CrmBundle\Entity\Address $addresses) {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses() {
        return $this->addresses;
    }

    /**
     * Add emails
     *
     * @param \CrmBundle\Entity\Email $emails
     * @return Person
     */
    public function addEmail(\CrmBundle\Entity\Email $emails) {
        $this->emails[] = $emails;

        return $this;
    }

    /**
     * Remove emails
     *
     * @param \CrmBundle\Entity\Email $emails
     */
    public function removeEmail(\CrmBundle\Entity\Email $emails) {
        $this->emails->removeElement($emails);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails() {
        return $this->emails;
    }

    /**
     * Add telephones
     *
     * @param \CrmBundle\Entity\Telephone $telephones
     * @return Person
     */
    public function addTelephone(\CrmBundle\Entity\Telephone $telephones) {
        $this->telephones[] = $telephones;

        return $this;
    }

    /**
     * Remove telephones
     *
     * @param \CrmBundle\Entity\Telephone $telephones
     */
    public function removeTelephone(\CrmBundle\Entity\Telephone $telephones) {
        $this->telephones->removeElement($telephones);
    }

    /**
     * Get telephones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTelephones() {
        return $this->telephones;
    }

    public function __toString() {
        return $this->name . ' ' . $this->surname;
    }
}
