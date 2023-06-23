<?php

namespace App\Controller\Api;

use App\Service\Weather;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather', name: 'app_api_weather')]
    public function index(Weather $weather): JsonResponse
    {
        $data = $weather->getData();

        return $this->json([
            'lat' => $data['coord']['lat'],
            'lon' => $data['coord']['lon'],
            'temp' => $data['main']['temp'],
            'description' => $data['weather'][0]['description']
        ]);
    }
}
