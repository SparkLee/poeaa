<?php

namespace Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain;

class Track extends DomainObject
{
    private $id;
    private $seq;
    private $albumId;
    private $title;

    public function __construct($id, $seq, $albumId, $title)
    {
        $this->id = $id;
        $this->seq = $seq;
        $this->albumId = $albumId;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


}