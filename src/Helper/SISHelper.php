<?php

namespace App\Helper;

use mysqli;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;

class SISHelper
{


    private $client;
    private $container;
    public function __construct(HttpClientInterface $httpClientInterface, ContainerInterface $container)
    {
        $this->client = HttpClient::create(['verify_peer' => false, 'verify_host' => false]);
        $this->container = $container;
    }
    public function getStudent()
    {
        $response = $this->client->request(
            'GET',
            sprintf('%s/report-api/student', $_ENV["SIS_URL"]),
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
    public function getConnection()
    {
        $host = $_ENV["SRS_URL"];
        $url = explode(',', $host);
        $conn = new mysqli($url[0], $url[1], $url[2], $url[3]);
        return $conn;
    }
    public function getTotalStudent()
    {
        $conn = $this->getConnection();
        $totalStudent = "SELECT count(id)  as totalstudent from student";
        if ($result = mysqli_query($conn, $totalStudent)) {
            // $totalS = array();
            $r = mysqli_fetch_assoc($result);
                $totalS = $r;
            
        }
        return $totalS['totalstudent'];
    }
    public function getBysex()
    {
        // INNER JOIN student_info ifo ON s.id=ifo.student_id
        //      JOIN student_detail sd ON s.id = sd.student_id
        //      where ifo.record_status=1
        $conn = $this->getConnection();
        $studentBasedOnSex = "SELECT sex, count(id)  as totalstudent from student 
        
              group by sex";
        if ($result = mysqli_query($conn, $studentBasedOnSex)) {
            $sex = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $sex[] = $r;
            }
        }
        // dd($sex);
        // $sisdb = "mysql  -h localhost -u root --password=123456 -D sis";
        // $cmd = $sisdb . " -e 'SELECT sex, count(id)  as totalstudent from student group by sex;'";
        return $sex;
    }
    // public function getByEnrollment()
    // {
    //     $conn = $this->getConnection();
    //     $enrollment = "SELECT sex, count(id)  as totalstudent from student group by sex";
    //     if ($result = mysqli_query($conn, $enrollment)) {
    //         $enrollments = array();
    //         while ($r = mysqli_fetch_assoc($result)) {
    //             $enrollments[] = $r;
    //         }
    //     }
    //     return $enrollments;
    // }
}
