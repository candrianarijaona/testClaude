<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Weather
{
    private const LATITUDE = '48.873487614726734';

    private const LONGITUDE = '2.3303383259931723';

    private const URL = 'https://api.openweathermap.org/data/2.5';

    public function __construct(private HttpClientInterface $client, private ParameterBagInterface $params)
    {

    }

    public function getData()
    {
        $url = sprintf('%s/weather?lat=%s&lon=%s&appid=%s&lang=%s&units=%s',
            self::URL,
            self::LATITUDE,
            self::LONGITUDE,
            $this->params->get('app.openweathermap.api_key'),
            'fr',
            'Metric'
        );

        $response = $this->client->request('GET', $url);

        return json_decode($response->getContent(), true);
    }
}