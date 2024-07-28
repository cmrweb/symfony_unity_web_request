<?php
namespace App\Service;

use App\Entity\User;
use App\Security\AuthAuthenticator;
use Cmrweb\UnityWebRequest\UnityRequest; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; 

class UnityRequestHandlerService extends UnityRequest
{ 
    public function  __construct(
        private readonly EntityManagerInterface $em,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly Security $security,
        private readonly ParameterBagInterface $param
    )
    {
            parent::__construct($param);
    }
    public function handleSuccess(object $data): JsonResponse
    {
        ###> do something ### 
        if(!isset($data->username) || !isset($data->password)) {
            return $this->handleError('invalid request missing data');
        }
        if(empty($data->username) || empty($data->password)) {
            return $this->handleError('fields cannot be empty');
        }

        $user = $this->em->getRepository(User::class)->findOneBy(['username' => $data->username]);
        if(null === $user) {
            $user = (new User())->setUsername($data->username);
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $data->password
            );
            $user->setPassword($hashedPassword);
    
            $this->em->persist($user);
            $this->em->flush();
            $data->status = "Created";
        }
        $data->status = "Connected";
        $this->security->login($user, AuthAuthenticator::class);
        ###< do something ### 
        return new JsonResponse(['Data'=> $data]);
    }

    public function handleError(string $message): JsonResponse
    {
        return new JsonResponse(['Error' => $message]);
    }

}