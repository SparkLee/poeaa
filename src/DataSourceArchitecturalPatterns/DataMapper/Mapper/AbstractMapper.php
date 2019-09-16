<?php

namespace Poeaa\DataSourceArchitecturalPatterns\DataMapper\Mapper;

use PDO;
use PDOException;
use PDOStatement;
use Ds\Vector;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\DomainObject;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\Person;

abstract class AbstractMapper
{
    /**
     * 标识映射
     *
     * @var array
     */
    protected $loadedMap = [];

    /**
     * 数据库连接
     *
     * @var \PDO
     */
    protected $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('sqlite:' . dirname(dirname(dirname(dirname(__DIR__)))) . '/database/poeaa.sqlite');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function findMany(StatementSource $source): Vector
    {
        $stmt = $this->pdo->prepare($source->sql());

        $parameters = $source->parameters();
        for ($i = 0; $i < count($parameters); $i++) {
            $stmt->bindValue($i + 1, $parameters[$i]);
        }

        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->loadAll($rows);
    }

    protected function loadAll($rows): Vector
    {
        $vector = new Vector();
        foreach ($rows as $row) {
            $vector->push($this->load($row));
        }
        return $vector;
    }

    protected function load($row)
    {
        $id = $row['id'];

        if (isset($this->loadedMap[$id])) {
            return $this->loadedMap[$id];
        }

        $result = $this->doLoad($id, $row);
        $this->loadedMap[$id] = $result;
        return $result;
    }

    protected abstract function doLoad($id, $row);

    /**
     * @param Person $subject
     *
     * @return int
     */
    public function insert(DomainObject $subject): int
    {
        $insertStatement = $this->pdo->prepare($this->insertStatement());
        $subject->setId(2);
        $insertStatement->bindValue(1, $subject->getId());
        $insertStatement = $this->doInsert($subject, $insertStatement);
        $insertStatement->execute();
        $this->loadedMap[$subject->getId()] = $subject;
        return $this->pdo->lastInsertId();
    }

    protected abstract function insertStatement();

    protected abstract function doInsert(DomainObject $subject, PDOStatement $insertStatement): PDOStatement;

    protected function abstractFind($id)
    {
        if (isset($this->loadedMap[$id])) {
            return $this->loadedMap[$id];
        }

        $findStatement = $this->pdo->prepare($this->findStatement());
        $findStatement->bindValue(1, $id, PDO::PARAM_INT);
        $findStatement->execute();
        $row = $findStatement->fetch(PDO::FETCH_ASSOC);
        $result = $this->load($row);
        return $result;
    }

    protected abstract function findStatement();
}