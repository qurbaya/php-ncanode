<?php

declare(strict_types=1);

namespace Oibay\Ncanode\Tests\Unit\Domains;

use Oibay\Ncanode\Domains\Verify;
use PHPUnit\Framework\TestCase;

class VerifyTest extends TestCase
{

    public function testSuccessfullyAdded(): void
    {
        $data = new Verify('<root>1</root>');

        $this->assertEquals([
            'revocationCheck' => [
                'OCSP'
            ],
            'xml' => '<root>1</root>'
        ], $data->toArray());
    }
}
