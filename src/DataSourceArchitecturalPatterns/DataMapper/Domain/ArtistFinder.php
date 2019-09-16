<?php

namespace Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain;

interface ArtistFinder
{
    public function find($id): Artist;
}