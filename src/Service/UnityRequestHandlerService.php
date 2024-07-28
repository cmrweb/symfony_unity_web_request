<?php
namespace App\Service;

use Cmrweb\UnityWebRequest\UnityRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class UnityRequestHandlerService extends UnityRequest
{ 
    public function handleSuccess(object $data): JsonResponse
    {
        ###> do something ###
        if(!isset($data->username)) {
            return $this->handleError('invalid username is missing');
        }
        if(empty($data->username)) {
            return $this->handleError('username cannot be empty'); 
        }
        // $unityTest = $this->serializer->deserialize($data, UnityTest::class, 'json');
        $data->password = 'data added from server';
        ###< do something ### 
        return new JsonResponse(['Data'=> $data]);
    }

    public function handleError(string $message): JsonResponse
    {
        return new JsonResponse(['Error' => $message]);
    }
}