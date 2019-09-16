<?php

declare(strict_types=1);

namespace Poeaa\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190916120912 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // 艺术家表
        $this->addSql("create table artists (
                id int primary key, 
                name varchar(50)
            )"
        );

        // 唱片表
        $this->addSql("create table album (
                id int primary key, 
                artistId int,
                title varchar(50)
            )"
        );

        // 歌曲表
        $this->addSql("create table tracks (
                id int primary key, 
                seq varchar(50),
                albumId int,
                title varchar(50)
            )"
        );
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("drop table if exists artists");
        $this->addSql("drop table if exists album");
        $this->addSql("drop table if exists tracks");
    }
}
