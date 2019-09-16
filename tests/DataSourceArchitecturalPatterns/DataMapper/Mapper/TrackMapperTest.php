<?php

namespace Tests\DataSourceArchitecturalPatterns\DataMapper\Mapper;

use Ds\Vector;
use PHPUnit\Framework\TestCase;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\Track;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Mapper\TrackMapper;

class TrackMapperTest extends TestCase
{

    public function testFindForAlbum()
    {
        $trackMapper = new TrackMapper();
        $tracks = $trackMapper->findForAlbum(1);
        $this->assertTrue($tracks instanceof Vector);
        $this->assertTrue($tracks->get(0) instanceof Track);
        $this->assertEquals('2002年的第一场雪', $tracks->get(0)->getTitle());
    }
}
