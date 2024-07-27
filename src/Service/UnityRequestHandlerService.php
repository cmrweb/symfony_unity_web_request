<?php
namespace App\Service;

use App\Entity\UnityTest;
use Cmrweb\UnityWebRequest\UnityRequest;
use Symfony\Component\HttpFoundation\JsonResponse; 

class UnityRequestHandlerService extends UnityRequest
{ 
    public function handleSuccess(object $data): JsonResponse
    {
        ###> do something ###
        if(!isset($data->field)) {
            return $this->handleError('invalid field is missing');
        }
        if(empty($data->field)) {
            return $this->handleError('field cannot be empty'); 
        }
        // $unityTest = $this->serializer->deserialize($data, UnityTest::class, 'json');
        $data->responseField = 'data added from server';
        ###< do something ### 
        return new JsonResponse(['Data'=> $data]);
    }

    public function handleError(string $message): JsonResponse
    {
        return new JsonResponse(['Error' => $message]);
    }
}