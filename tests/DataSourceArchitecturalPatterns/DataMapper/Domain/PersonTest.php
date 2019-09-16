<?php

namespace Tests\DataSourceArchitecturalPatterns\DataMapper\Domain;

use PHPUnit\Framework\TestCase;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\Person;

class PersonTest extends TestCase
{
    public function testConstruct()
    {
        $person = new Person(1, 'Spark', 'Lee', 108);
        $this->assertEquals(1, $person->getId());
        $this->assertEquals('Spark', $person->getLastName());
        $this->assertEquals('Lee', $person->getFirstName());
        $this->assertEquals(108, $person->getNumberOfDependents());
    }

}
