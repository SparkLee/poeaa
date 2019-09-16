<?php

declare(strict_types=1);

namespace Poeaa\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190915085457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    /**
     * 创建人员表
     *
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->addSql("create table people (
                id int primary key, 
                lastname varchar(50),
                firstname varchar(50),
                number_of_dependents int
            )"
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql("drop table if exists people");
    }
}
