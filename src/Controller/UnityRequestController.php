<?php

namespace App\Controller;

use App\Service\UnityRequestHandlerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UnityRequestController extends AbstractController
{
    #[Route('/unity/request', name: 'app_unity_request')]
    public function index(Request $request, UnityRequestHandlerService $unityRequestHandler): Response
    { 
        return $unityRequestHandler->handleRequest($request);
    }
}
