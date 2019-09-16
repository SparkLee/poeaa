<?php

namespace Poeaa\DataSourceArchitecturalPatterns\DataMapper\Mapper;

use PDOStatement;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\Artist;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\ArtistFinder;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\DomainObject;

class ArtistMapper extends AbstractMapper implements ArtistFinder
{
    const COLUMN_LIST = "art.id, art.name";

    public function find($id): Artist
    {
        return $this->abstractFind($id);
    }

    protected function doLoad($id, $row)
    {
        $result = new Artist($id, $row['name']);
        return $result;
    }

    protected function insertStatement()
    {
        // TODO: Implement insertStatement() method.
    }

    protected function doInsert(DomainObject $subject, PDOStatement $insertStatement): PDOStatement
    {
        // TODO: Implement doInsert() method.
    }

    protected function findStatement()
    {
        return "SELECT " . self::COLUMN_LIST . " FROM artists art WHERE id = ?";
    }
}