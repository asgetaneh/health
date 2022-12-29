<?php

namespace App\Controller;

use App\Entity\UserInfo;
use App\Form\UserInfoType;
use App\Repository\UserInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user/info')]
class UserInfoController extends AbstractController
{
    #[Route('/', name: 'app_user_info_index', methods: ['GET'])]
    public function index(UserInfoRepository $userInfoRepository): Response
    {
        return $this->render('user_info/index.html.twig', [
            'user_infos' => $userInfoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_info_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
         $entityManager = $this->getDoctrine()->getManager();
        $userInfo = new UserInfo();
        $form = $this->createForm(UserInfoType::class, $userInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($userInfo);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_info_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_info/new.html.twig', [
            'user_info' => $userInfo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_user_info_show', methods: ['GET'])]
    public function show(UserInfo $userInfo): Response
    {
        return $this->render('user_info/show.html.twig', [
            'user_info' => $userInfo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_info_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserInfo $userInfo): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(UserInfoType::class, $userInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_info_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_info/edit.html.twig', [
            'user_info' => $userInfo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_user_info_delete', methods: ['POST'])]
    public function delete(Request $request, UserInfo $userInfo): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        if ($this->isCsrfTokenValid('delete'.$userInfo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($userInfo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_info_index', [], Response::HTTP_SEE_OTHER);
    }
}
