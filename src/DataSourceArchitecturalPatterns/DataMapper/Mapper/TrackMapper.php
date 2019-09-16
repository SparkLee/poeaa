<?php

namespace Poeaa\DataSourceArchitecturalPatterns\DataMapper\Mapper;

use PDO;
use PDOStatement;
use Ds\Vector;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\DomainObject;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\Track;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\TrackFinder;

class TrackMapper extends AbstractMapper implements TrackFinder
{

    private $findForAlbumStatement =
        "SELECT id, seq, albumId, title" .
        " FROM tracks" .
        " WHERE albumId = ? ORDER BY seq";

    public function find($id): Track
    {
        // TODO: Implement find() method.
    }

    public function findForAlbum($albumId): Vector
    {
        $stmt = $this->pdo->prepare($this->findForAlbumStatement);
        $stmt->bindValue(1, $albumId);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = $this->loadAll($rows);
        return $result;
    }

    protected function doLoad($id, $row)
    {
        return new Track($id, $row['seq'], $row['albumId'], $row['title']);
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
        // TODO: Implement findStatement() method.
    }
}