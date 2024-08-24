<?php

declare(strict_types=1);

namespace Drupal\location_finder\API\Dhl;

use Drupal\location_finder\Exceptions\ApiException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

class Client
{
    private const HOST = 'https://api-sandbox.dhl.com';
    private const API = 'location-finder/v1';

    public function __construct(private readonly ClientInterface $client)
    {
    }

    public function findByAddress(string $countryCode, string $addressLocality, string $postalCode): string
    {
        $options = [
            'query' => [
                'countryCode' => $countryCode,
                'addressLocality' => $addressLocality,
                'postalCode' => $postalCode,
            ],
            'headers'  => [
                'DHL-API-Key' => 'demo-key'
            ],
        ];

        try {
            return $this->client->get(self::HOST . '/' . self::API . '/find-by-address', $options)
                ->getBody()
                ->getContents();

        } catch (ClientException $e) {
            $body = $e->getResponse()->getBody()->getContents();
            $data = json_decode($body, true);
            $message = sprintf('Client error: `%s`', $data['detail'] ?? $data['title'] ?? 'unknown');

            throw new ApiException($message);
        } catch (GuzzleException $e) {
            $message = sprintf('Client error: `%s`', $e->getMessage());

            throw new ApiException($message);
        }
    }
}
