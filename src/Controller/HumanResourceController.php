<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HumanResourceController extends AbstractController
{
    /**
     * @Route("/human/resource", name="human_resource")
     */
    public function index(): Response
    {
        return $this->render('human_resource/index.html.twig', [
            'controller_name' => 'HumanResourceController',
        ]);
    }
}
