<?php

namespace App\Controller;

use App\Service\UnityRequestHandlerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UnityRequestController extends AbstractController
{

    #[Route(path: '/', name: 'app_game')]
    public function index() : Response
    {
        return $this->render('unity/index.html.twig');
    }

    #[Route('/unity/request', name: 'app_unity_request')]
    public function request(Request $request, UnityRequestHandlerService $unityRequestHandler): Response
    { 
        return $unityRequestHandler->handleRequest($request);
    }
}
