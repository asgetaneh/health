<?php

namespace App\Helper;

use mysqli;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;

class SRSHelper
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
        $totalStudent = "SELECT count(s.id)  as totalstudent from student s INNER JOIN student_info ifo ON s.id=ifo.student_id where ifo.record_status=1";
        if ($result = mysqli_query($conn, $totalStudent)) {
            // $totalS = array();
            $r = mysqli_fetch_assoc($result);
            $totalS = $r;
        }
        return $totalS['totalstudent'];
    }
    public function getBysex()
    {
       
        $conn = $this->getConnection();
        $studentBasedOnSex = "SELECT s.sex, count(s.id)  as totalstudent from student s INNER JOIN student_info ifo ON s.id=ifo.student_id where ifo.record_status=1
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
    public function getByYear()
    {
        $conn = $this->getConnection();
        $studentBasedOnSex = "SELECT s.sex,ifo.year, count(s.id)  as totalstudent from student s INNER JOIN student_info ifo ON s.id=ifo.student_id where ifo.record_status=1 group by s.sex,ifo.year";
        if ($result = mysqli_query($conn, $studentBasedOnSex)) {
            $sex = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $sex[] = $r;
            }
        }
        
        return $sex;
    }
    
    public function getByEnrollment()
    {
        $conn = $this->getConnection();
        $enrollment = "SELECT s.sex, en.enrollment_type_name, count(s.id) as totalstudent from student s INNER JOIN student_info ifo ON s.id=ifo.student_id INNER JOIN program p ON ifo.program_id=p.id INNER JOIN enrollment_type en ON p.enrollment_type_id=en.id where ifo.record_status=1 group by s.sex,en.enrollment_type_name";
             
        if ($result = mysqli_query($conn, $enrollment)) {
            $enrollments = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $enrollments[] = $r;
            }
        }
        return $enrollments;
    }
     public function getByProgramLevel()
    {
        $conn = $this->getConnection();
        $enrollment = " SELECT s.sex, pl.program_level_name, count(s.id) as totalstudent from student s INNER JOIN student_info ifo ON s.id=ifo.student_id INNER JOIN program p ON ifo.program_id=p.id INNER JOIN program_level pl ON p.program_level_id=pl.id where ifo.record_status=1 group by s.sex,pl.program_level_name";
             
        if ($result = mysqli_query($conn, $enrollment)) {
            $enrollments = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $enrollments[] = $r;
            }
        }
        return $enrollments;
    }
     public function getProgram()
    {
        $conn = $this->getConnection();
        $totalProgram= " SELECT  count(id) as totalProgram from program s ";
             
        if ($result = mysqli_query($conn, $totalProgram)) {
            // $programs = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $programs[] = $r;
            }
        }

        return $programs['totalProgram'];
    }
    public function getByProgram()
    {
        $conn = $this->getConnection();
        $enrollment = " SELECT s.sex, p.name, count(s.id) as totalstudent from student s INNER JOIN student_info ifo ON s.id=ifo.student_id INNER JOIN program p ON ifo.program_id=p.id where ifo.record_status=1 group by s.sex,p.name";
             
        if ($result = mysqli_query($conn, $enrollment)) {
            $studentByPrograms = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $studentByPrograms[] = $r;
            }
        }
        return $studentByPrograms;
    }
   
}
