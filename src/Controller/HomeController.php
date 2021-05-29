<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/changeLocale", name="change_locale")
     */
    public function changeLocale(Request $request)
    {
        $language = ['en', 'am', 'or'];
        $lang = $request->request->get('lang');
        $response['success'] = false;
        if (in_array($lang, $language)) {
            $response['success'] = true;
            $this->get('session')->set('_locale', $lang);
        }

        return new JsonResponse(['success' => true]);
    }
}
