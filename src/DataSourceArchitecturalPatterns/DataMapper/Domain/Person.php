<?php

namespace Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain;

class Person extends DomainObject
{
    private $id;
    private $lastName;
    private $firstName;
    private $numberOfDependents;

    public function __construct($id, $lastNameArg, $firstNameArg, $numDependentsArg)
    {
        $this->id = $id;
        $this->lastName = $lastNameArg;
        $this->firstName = $firstNameArg;
        $this->numberOfDependents = $numDependentsArg;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Person
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return Person
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfDependents()
    {
        return $this->numberOfDependents;
    }

    /**
     * @param int $numberOfDependents
     *
     * @return Person
     */
    public function setNumberOfDependents($numberOfDependents)
    {
        $this->numberOfDependents = $numberOfDependents;
        return $this;
    }
}