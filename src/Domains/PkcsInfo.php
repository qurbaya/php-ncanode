<?php

declare(strict_types=1);


namespace Oibay\Ncanode\Domains;

use Oibay\Ncanode\Domains\Constants\Action;
use Oibay\Ncanode\Domains\Contracts\DomainInterface;
use Webmozart\Assert\Assert;

class PkcsInfo implements DomainInterface
{

    private string $key;
    private string $password;
    private ?string $alies = null;

    public function __construct(string $key, string $password, ?string $alies)
    {
        Assert::notEmpty($key);
        Assert::notEmpty($password);
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
