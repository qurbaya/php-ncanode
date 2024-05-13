<?php

namespace Oibay\Ncanode\Domains;

use Oibay\Ncanode\Domains\Constants\Action;
use Oibay\Ncanode\Domains\Contracts\DomainInterface;

class PkcsInfo implements DomainInterface
{

    private string $key;
    private string $password;
    private ?string $alies = null;

    /**
     * @param string $key The key in Base64 format.
     * @param string $password
     * @param string|null $alies
     */
    public function __construct(string $key, string $password, ?string $alies)
    {
        $this->key = $key;
        $this->password = $password;
        $this->alies = $alies;
    }


    public function getAction(): string
    {
        return Action::PKCS12_INFO;
    }

    public function toArray(): array
    {
        return [
           'revocationCheck' => [
               'OCSP'
           ],
           'keys' => [
              [
                  'key' => $this->key,
                  'password' => $this->password,
                  'keyAlias' => $this->alies
              ]
           ]
        ];
    }
}