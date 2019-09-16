<?php

namespace Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain;

use Ds\Vector;

interface TrackFinder
{
    public function find($id): Track;

    public function findForAlbum($albumId): Vector;
}