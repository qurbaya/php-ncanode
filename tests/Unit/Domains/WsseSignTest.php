<?php

namespace Unit\Domains;

use Oibay\Ncanode\Domains\WsseSign;
use PHPUnit\Framework\TestCase;

class WsseSignTest extends TestCase
{


    public function testSuccessfullyAdded(): void
    {
        $data = new WsseSign(
            '<root></root>',
            '123',
            '123',
            null,
            true
        );

        $this->assertEquals([
            'xml'           => '<root></root>',
            'key'           => '123',
            'password'      => '123',
            'keyAlias'      => null,
            'trimXml'       => true
        ], $data->toArray());
    }
}