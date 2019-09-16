<?php

namespace Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain;

class Artist extends DomainObject
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}