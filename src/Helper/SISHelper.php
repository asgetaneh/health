<?php

namespace App\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;

class SISHelper {

 
    private $client;
    private $container;
    public function __construct(HttpClientInterface $httpClientInterface,ContainerInterface $container)
    {
        $this->client=HttpClient::create(['verify_peer' => false, 'verify_host' => false]);
        $this->container=$container;

    }
     public function getStudent()
    {
        $response = $this->client->request(
            'GET',
            sprintf('%s/report-api/student',$_ENV["SIS_URL"]),
            [
                'headers' => [
                    'Accept' => 'application/json',
                   // 'X-AUTH-TOKEN' => $this->container->getParameter("msg_api_token"),
                ],

            ],
        );

      //  $statusCode = $response->getStatusCode();
      return  json_decode($response->getContent());
      
       
    }

    public function sendSms($title="title",$message="message",$phone_numbers=[])
    {
        try {
           
    //  dd(1);

        $response = $this->client->request(
            'POST',
            sprintf('%s/message-request/create',$this->container->getParameter("msg_api_host")),
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'X-AUTH-TOKEN' => $this->container->getParameter("msg_api_token"),
                ],

              'body' => ['title' => $title, 'message'=>$message,"phone_numbers"=>$phone_numbers],
            ],
        );

        $statusCode = $response->getStatusCode();
        // $content = $response->getContent();
        // $content = $response->toArray();

        //  dd($response->getContent()
        // );
       return $statusCode==200;
       return false;

    } catch (\Throwable $th) {
       
      return false;
    }


      
    }
}