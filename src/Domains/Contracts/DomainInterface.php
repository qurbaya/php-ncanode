<?php

declare(strict_types=1);

namespace Oibay\Ncanode\Domains\Contracts;

interface DomainInterface
{
    public function getAction(): string;

    public function toArray(): array;
}