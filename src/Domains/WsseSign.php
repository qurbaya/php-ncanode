<?php

declare(strict_types=1);

namespace Oibay\Ncanode\Domains;

use Oibay\Ncanode\Domains\Constants\Action;
use Oibay\Ncanode\Domains\Contracts\DomainInterface;

class WsseSign implements DomainInterface
{
    private string $xml;
    private string $key;
    private string $password;
    private ?string $keyAlias;
    private bool $trimXml;


    public function __construct(string $xml, string $key, string $password, ?string $keyAlias = null, bool $trimXml = false)
    {
        $this->xml = $xml;
        $this->key = $key;
        $this->password = $password;
        $this->keyAlias = $keyAlias;
        $this->trimXml = $trimXml;
    }


    public function getAction(): string
    {
        return Action::WSSE_SIGN;
    }

    public function toArray(): array
    {
        return [
            'xml'           => $this->xml,
            'key'           => $this->key,
            'password'      => $this->password,
            'keyAlias'      => $this->keyAlias,
            'trimXml'       => $this->trimXml
        ];
    }
}