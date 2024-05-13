<?php

declare(strict_types=1);

namespace Oibay\Ncanode\Client;

use Oibay\Ncanode\Client\Contracts\ClientInterface;
use Oibay\Ncanode\Client\Exceptions\HttpException;

class Client implements ClientInterface
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }
    public function execute(string $action, array $data): mixed
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->url . $action);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $result = curl_exec($curl);
        $code = curl_errno($curl);
        $message = curl_error($curl);

        curl_close($curl);

        if ($code) {
            throw new HttpException($message, $code);
        }

        return json_decode((string)$result, true);
    }
}