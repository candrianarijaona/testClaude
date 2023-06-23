<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(HttpClientInterface $client): Response
    {
        $url = sprintf('https://api.openweathermap.org/data/2.5/weather?lat=%s&lon=%s&appid=%s&lang=%s&units=%s',
            '48.873487614726734',
            '2.3303383259931723',
            'acc2caec8e1294a40424dde232848027',
            'fr',
            'Metric'
        );

        $response = $client->request('GET', $url);

        return $this->render('home/index.html.twig',
        [
            'data' => json_decode($response->getContent(), true),
        ]);
    }
}
