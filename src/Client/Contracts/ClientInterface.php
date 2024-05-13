<?php

declare(strict_types=1);

namespace Oibay\Ncanode\Client\Contracts;

interface ClientInterface
{
    public function execute(string $action, array $data): mixed;
}