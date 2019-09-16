<?php

namespace Poeaa\DataSourceArchitecturalPatterns\DataMapper\Mapper;

use PDO;
use PDOStatement;
use Ds\Vector;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\DomainObject;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\Person;

class PersonMapper extends AbstractMapper
{
    const COLUMNS = " id, lastname, firstname, number_of_dependents";

    private $findLastNameStatement =
        "SELECT " . self::COLUMNS .
        " FROM people" .
        " WHERE UPPER(lastname) LIKE UPPER(?)" .
        " ORDER BY lastname";

    private $updateStatementString =
        "UPDATE people" .
        " SET lastname = ?, firstname = ?, number_of_dependents = ?" .
        " WHERE id = ?";

    public function find($id)
    {
        return $this->abstractFind($id);
    }

    public function findByLastName(string $name): Vector
    {
        $stmt = $this->pdo->prepare($this->findLastNameStatement);
        $stmt->bindValue(1, $name);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->loadAll($rows);
    }

    public function findByLastName2(string $pattern): Vector
    {
        $source = new Class($pattern, self::COLUMNS) implements StatementSource
        {
            private $lastName;
            private $columns;

            public function __construct(string $lastName, string $columns)
            {
                $this->lastName = $lastName;
                $this->columns = $columns;
            }

            public function sql(): string
            {
                return "SELECT " . $this->columns .
                    " FROM people" .
                    " WHERE UPPER(lastname) LIKE UPPER(?)" .
                    " ORDER BY lastname";
            }

            public function parameters(): array
            {
                return [$this->lastName];
            }
        };

        return $this->findMany($source);
    }

    public function update(Person $subject)
    {
        $updateStatement = $this->pdo->prepare($this->updateStatementString);
        $updateStatement->bindValue(1, $subject->getLastName());
        $updateStatement->bindValue(2, $subject->getFirstName());
        $updateStatement->bindValue(3, $subject->getNumberOfDependents());
        $updateStatement->bindValue(4, $subject->getId());
        $updateStatement->execute();
    }

    protected function findStatement(): string
    {
        return "SELECT " . self::COLUMNS .
            " FROM people" .
            " WHERE id = ?";
    }

    protected function doLoad($id, $row)
    {
        $lastNameArg = $row['lastname'];
        $firstNameArg = $row['firstname'];
        $numDependentsArg = $row['number_of_dependents'];
        return new Person($id, $lastNameArg, $firstNameArg, $numDependentsArg);
    }

    protected function insertStatement(): string
    {
        return "INSERT INTO people VALUES (?, ?, ?, ?)";
    }

    /**
     * @param Person       $abstractSubject
     * @param PDOStatement $stmt
     *
     * @return PDOStatement
     */
    protected function doInsert(DomainObject $abstractSubject, PDOStatement $stmt): PDOStatement
    {
        $person = $abstractSubject;
        $stmt->bindValue(2, $person->getLastName());
        $stmt->bindValue(3, $person->getFirstName());
        $stmt->bindValue(4, $person->getNumberOfDependents());
        return $stmt;
    }

}