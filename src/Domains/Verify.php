<?php

declare(strict_types=1);

namespace Oibay\Ncanode\Domains;

use Oibay\Ncanode\Domains\Constants\Action;
use Oibay\Ncanode\Domains\Contracts\DomainInterface;
use Webmozart\Assert\Assert;

class Verify implements DomainInterface
{
    private string $xml;

    public function __construct(string $xml)
    {
        Assert::notEmpty($xml);
        $this->xml = $xml;
    }

    public function getAction(): string
    {
        return Action::XML_VERIFY;
    }


    public function toArray(): array
    {
        return [
            'revocationCheck' => [
                'OCSP'
            ],
            'xml' => $this->xml
        ];
    }
}
