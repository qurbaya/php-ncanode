<?php

declare(strict_types=1);

namespace Oibay\Ncanode\Tests\Unit\Domains;

use Oibay\Ncanode\Domains\PkcsInfo;
use PHPUnit\Framework\TestCase;

class PkcsInfoTest extends TestCase
{

    public function testSuccessfullyAdded(): void
    {
        $data = new PkcsInfo(base64_encode('test'),'123','123');

        $this->assertEquals([
            'revocationCheck' => [
                'OCSP'
            ],
            'keys' => [
                [
                    'key' => base64_encode('test'),
                    'password' => '123',
                    'keyAlias' => '123'
                ]
            ]
        ], $data->toArray());
    }
}
