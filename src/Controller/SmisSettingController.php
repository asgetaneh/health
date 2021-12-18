<?php

namespace App\Controller;

use App\Entity\SmisSetting;
use App\Form\SmisSettingType;
use App\Repository\SmisSettingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/smis/setting')]
class SmisSettingController extends AbstractController
{
    #[Route('/', name: 'smis_setting_index', methods: ['GET'])]
    public function index(SmisSettingRepository $smisSettingRepository): Response
    {
        return $this->render('smis_setting/index.html.twig', [
            'smis_settings' => $smisSettingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'smis_setting_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $smisSetting = new SmisSetting();
        $form = $this->createForm(SmisSettingType::class, $smisSetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($smisSetting);
            $entityManager->flush();

            return $this->redirectToRoute('smis_setting_index');
        }

        return $this->render('smis_setting/new.html.twig', [
            'smis_setting' => $smisSetting,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'smis_setting_show', methods: ['GET'])]
    public function show(SmisSetting $smisSetting): Response
    {
        return $this->render('smis_setting/show.html.twig', [
            'smis_setting' => $smisSetting,
        ]);
    }

    #[Route('/{id}/edit', name: 'smis_setting_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SmisSetting $smisSetting): Response
    {
        $form = $this->createForm(SmisSettingType::class, $smisSetting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('smis_setting_index');
        }

        return $this->render('smis_setting/edit.html.twig', [
            'smis_setting' => $smisSetting,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'smis_setting_delete', methods: ['DELETE'])]
    public function delete(Request $request, SmisSetting $smisSetting): Response
    {
        if ($this->isCsrfTokenValid('delete'.$smisSetting->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($smisSetting);
            $entityManager->flush();
        }

        return $this->redirectToRoute('smis_setting_index');
    }
}
