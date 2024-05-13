<?php

declare(strict_types=1);

namespace Oibay\Ncanode\Tests\Unit\Domains;

use Oibay\Ncanode\Domains\X509Info;
use PHPUnit\Framework\TestCase;


class x509InfoTest extends TestCase
{

    public function testSuccessfullyAdded(): void
    {
        $data = new X509Info('<root>1</root>');

        $this->assertEquals([
            'revocationCheck' => [
                'OCSP'
            ],
            'certs' => '<root>1</root>'
        ], $data->toArray());
    }
}
