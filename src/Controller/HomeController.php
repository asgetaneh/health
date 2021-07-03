<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('general.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
     /**
     * @Route("/changeLocale/{locale}", name="change_locale")
     */
    public function changeLocale(Request $request,$locale)
    {
       
            $this->get('session')->set('_locale', $locale);
             $referer = $request->headers->get('referer');
               return $this->redirect($referer);
       

        
    }
}
