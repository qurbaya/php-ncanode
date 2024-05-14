<?php

declare(strict_types=1);

namespace Oibay\Ncanode\Domains;

use Oibay\Ncanode\Domains\Constants\Action;
use Oibay\Ncanode\Domains\Contracts\DomainInterface;

class XMLSign implements DomainInterface
{

    private string $xml;
    private string $key;
    private string $password;
    private ?string $keyAlias;
    private bool $clearSignatures;
    private bool $trimXml;


    public function __construct(string $xml,
                                string $key,
                                string $password,
                                ?string $keyAlias = null,
                                bool $clearSignatures = false,
                                bool $trimXml = false)
    {
        $this->xml = $xml;
        $this->key = $key;
        $this->password = $password;
        $this->keyAlias = $keyAlias;
        $this->clearSignatures = $clearSignatures;
        $this->trimXml = $trimXml;
    }

    public function getAction(): string
    {
        return Action::XML_SIGN;
    }

    public function toArray(): array
    {
        return [
            'xml' => $this->xml,
            'signers' => [
                'key' => $this->key,
                'password' => $this->password,
                'keyAlias' => $this->keyAlias,
            ],
            'clearSignatures' => $this->clearSignatures,
            'trimXml' => $this->trimXml,
        ];
    }
}
