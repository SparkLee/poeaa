<?php

namespace Tests\DataSourceArchitecturalPatterns\DataMapper\Mapper;

use Ds\Vector;
use PHPUnit\Framework\TestCase;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\Person;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Mapper\PersonMapper;

class PersonMapperTest extends TestCase
{
    public function testFind()
    {
        $id = 1;
        $personMapper = new PersonMapper();
        $person = $personMapper->find($id);
        $this->assertTrue($person instanceof Person);
    }

    public function testFindByLastName()
    {
        $lastname = 'Lee';

        $vector = new Vector(
            [
                new Person(1, 'Lee', 'Wei', 108),
            ]
        );

        $personMapper = new PersonMapper();
        $persons = $personMapper->findByLastName($lastname);
        $this->assertEquals($vector->get(0), $persons->get(0));
    }

    public function testFindByLastName2()
    {
        $lastname = 'Lee';
        $personMapper = new PersonMapper();
        $persons = $personMapper->findByLastName2($lastname);
        $this->assertTrue($persons->get(0) instanceof Person);
        $this->assertEquals('Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\Person', get_class($persons->get(0)));
        $this->assertEquals('object', gettype($persons));
        $this->assertEquals('object', gettype($persons->get(0)));
    }

    public function testUpdate()
    {
        $person = new Person(1, 'Lee', 'Wei', '108');
        $personMapper = new PersonMapper();
        $personMapper->update($person);
        $this->assertEquals('Wei', $personMapper->find(1)->getFirstName());
    }

    public function testInsert()
    {
        $person = new Person(2, 'Bergmann', 'Sebastian', 3);
        $personMapper = new PersonMapper();
        $personMapper->insert($person);
        $this->assertEquals($person, $personMapper->find(2));

        // 在insert方法中已将待持久化的$person对象缓存在标识映射数组中，所以两个$person其中是指向同一个对象
        $this->assertSame($person, $personMapper->find(2));
    }
}
