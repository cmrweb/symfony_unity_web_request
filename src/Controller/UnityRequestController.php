<?php

namespace App\Controller;

use App\Security\AuthAuthenticator;
use App\Service\UnityRequestHandlerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UnityRequestController extends AbstractController
{

    #[Route(path: '/', name: 'app_game')]
    public function index() : Response
    {
        return $this->render('unity/index.html.twig', []);
    }

    #[Route('/unity/request', name: 'app_unity_request')]
    public function request(Request $request, UnityRequestHandlerService $unityRequestHandler, Security $security): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if(null === $user) {
            return $unityRequestHandler->handleRequest($request);
        }
        $security->login($user, AuthAuthenticator::class);
        return new JsonResponse(['Data' =>['username' => $user->getUsername() , 'password' => 'Already connected']]);
    }
}
