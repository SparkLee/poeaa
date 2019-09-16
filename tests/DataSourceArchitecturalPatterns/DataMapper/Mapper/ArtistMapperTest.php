<?php

namespace Tests\DataSourceArchitecturalPatterns\DataMapper\Mapper;

use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Domain\Artist;
use Poeaa\DataSourceArchitecturalPatterns\DataMapper\Mapper\ArtistMapper;
use PHPUnit\Framework\TestCase;

class ArtistMapperTest extends TestCase
{
    public function testFind()
    {
        $artMapper = new ArtistMapper();
        $art = $artMapper->find(1);
        $this->assertTrue($art instanceof Artist);
    }
}
