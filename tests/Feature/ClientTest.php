<?php

declare(strict_types=1);


namespace Oibay\Ncanode\Tests\Feature;

use Oibay\Ncanode\Client;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /** @var MockObject|Client $client */
    private $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = $this->getMockBuilder(Client::class)->getMock();
    }

    public function testVerifyXml(): void
    {
        $this->client->method('verifyXML')->willReturn(['status' => 200]);
        $res = $this->client->verifyXML('<root></root>');
        $this->assertEquals(['status' => 200], $res);
    }

    public function testX509Info(): void
    {
        $this->client->method('x509Info')->willReturn(['status' => 200]);
        $res = $this->client->x509Info(base64_encode('<root></root>'));
        $this->assertEquals(['status' => 200], $res);
    }

    public function testPkcsInfo(): void
    {
        $this->client->method('pkcsInfo')->willReturn(['status' => 200]);
        $res = $this->client->pkcsInfo(base64_encode('<root></root>'),'123');
        $this->assertEquals(['status' => 200], $res);
    }
}