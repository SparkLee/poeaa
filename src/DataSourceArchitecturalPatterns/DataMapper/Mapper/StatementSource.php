<?php

namespace Poeaa\DataSourceArchitecturalPatterns\DataMapper\Mapper;

interface StatementSource
{
    public function sql(): string;

    public function parameters(): array;
}