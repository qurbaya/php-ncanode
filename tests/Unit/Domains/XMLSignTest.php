<?php

declare(strict_types=1);

namespace Oibay\Ncanode\Tests\Unit\Domains;

use Oibay\Ncanode\Domains\XMLSign;
use PHPUnit\Framework\TestCase;

class XMLSignTest extends TestCase
{


    public function testSuccessfullyAdded(): void
    {
        $data = new XMLSign(
            '<root></root>',
            base64_encode('123'),
            '123',

        );

        $this->assertEquals(
            [
                'xml' => '<root></root>',
                'signers' => [
                    'key' => base64_encode('123'),
                    'password' => '123',
                    'keyAlias' => null,
                ],
                'clearSignatures' => false,
                'trimXml' => false,
            ],$data->toArray()
        );
    }
}
