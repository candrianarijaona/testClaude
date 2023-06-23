<?php

namespace App\Controller;

use App\Service\Weather;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(Weather $weather): Response
    {
        return $this->render('home/index.html.twig',
        [
            'data' => $weather->getData()
        ]);
    }
}
