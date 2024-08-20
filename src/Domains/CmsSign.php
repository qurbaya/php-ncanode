<?php

declare(strict_types=1);


namespace Oibay\Ncanode\Domains;

use Oibay\Ncanode\Domains\Constants\Action;
use Oibay\Ncanode\Domains\Contracts\DomainInterface;

class CmsSign implements DomainInterface
{

    private string $data;

    private string $key;

    private string $password;

    private bool $withTsp;

    private string $tsaPolicy;

    private bool $detached;

    private ?string $alies;

    /**
     * @param string $data
     * @param string $key
     * @param string $password
     * @param bool $withTsp
     * @param string $tsaPolicy
     * @param bool $detached
     * @param string|null $alies
     */
    public function __construct(string $data, string $key, string $password, bool $withTsp = true, string $tsaPolicy = 'TSA_GOST_POLICY', bool $detached = false, ?string $alies = null)
    {
        $this->data = $data;
        $this->key = $key;
        $this->password = $password;
        $this->withTsp = $withTsp;
        $this->tsaPolicy = $tsaPolicy;
        $this->detached = $detached;

        $this->alies = $alies;
    }


    public function getAction(): string
    {
        return Action::CMS_SIGN;
    }

    public function toArray(): array
    {
        return [
            'data'      => $this->data,
            'signers'   => [
                [
                    'key' => $this->key,
                    'password' => $this->password,
                    'keyAlias'  => $this->alies,
                ]
            ],
            'withTsp'   => $this->withTsp,
            'tsaPolicy' => $this->tsaPolicy,
            'detached'  => $this->detached,
        ];
    }
}