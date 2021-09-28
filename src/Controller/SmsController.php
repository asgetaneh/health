<?php

namespace App\Controller;

use App\Entity\OperationalManager;
use App\Entity\OperationalOffice;
use App\Entity\Performer;
use App\Entity\PrincipalManager;
use App\Entity\PrincipalOffice;
use App\Entity\Sms;
use App\Entity\UserInfo;
use App\Form\SmsType;
use App\Helper\SmsHelper;
use App\Repository\SmsRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sms")
 */
class SmsController extends AbstractController
{
    /**
     * @Route("/", name="sms_index")
     */


    public function index(Request $request, UserRepository $userRepository, SmsHelper $smsHelper)
    {
        // $this->denyAccessUnlessGranted('sms_send');

        $em = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder()

            ->add('principalOffice', EntityType::class, [
                'class' => PrincipalOffice::class,
                'multiple' => true,
                // 'placeholder' => 'All',
                'placeholder' => "All",

                'required' => false
            ])
            ->add('operationalOffice', EntityType::class, [
                'class' => OperationalOffice::class,
                'multiple' => true,
                'required' => false
            ])
            ->add('performer', EntityType::class, [
                'class' => UserInfo::class,
                'multiple' => true,
                'required' => false
            ])

            ->add('message', TextareaType::class, [

                'required' => false
            ])
            ->getForm();
        $form->handleRequest($request);
        $mobileNumber = [];
        $message = 0;

        if ($form->isSubmitted() && $form->isValid()) {
            // $operationalOffice= $filterform->getData([]);
            $data = $form->getData();

            //  $mobileNumber[]=null;
            $message = $data["message"];
            $users = $userRepository->search($form->getData());
            // dd($sms,$message);
            foreach ($users as $key) {
                $mobileNumber[] = $key->getMobile();
                // dump($mobileNumber);
            }
            //   dd($mobileNumber,$message);

            $smsHelper->sendSms("MIS Message ", $message, json_encode($mobileNumber));
            foreach ($users as $user) {
                $sms = new Sms();
                $sms->setSender($this->getUser());
                $sms->setReciver($user);
                $sms->setSendDate(new \DateTime());
                $sms->setText($message);
                $em->persist($sms);
            }
            $em->flush();
            $this->addFlash('success', "Message successfuly Send");
            return $this->redirectToRoute('sms_index');
        }
        if ($request->request->get("allmessgae")) {
            $mobileNumber = [];
            $message = $request->request->get("message");
            $users = $userRepository->findAll();
            foreach ($users as $user) {
                $mobileNumber[] = $user->getMobile();
            }
            //    dd($mobileNumber);
            $smsHelper->sendSms("MIS Message ", $message, json_encode($mobileNumber));

            $this->addFlash('success', "Message successfuly Send");
            return $this->redirectToRoute('sms_index');
        }

        // $entityManager = $this->getDoctrine()->getManager();


        // return $this->redirectToRoute('planning_year_index');
        return $this->render('sms/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/new", name="sms_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sms = new Sms();
        $form = $this->createForm(SmsType::class, $sms);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sms);
            $entityManager->flush();

            return $this->redirectToRoute('sms_index');
        }

        return $this->render('sms/new.html.twig', [
            'sms' => $sms,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sms_show", methods={"GET"})
     */
    public function show(Sms $sms): Response
    {
        return $this->render('sms/show.html.twig', [
            'sms' => $sms,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sms_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sms $sms): Response
    {
        $form = $this->createForm(SmsType::class, $sms);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sms_index');
        }

        return $this->render('sms/edit.html.twig', [
            'sms' => $sms,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sms_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sms $sms): Response
    {
        if ($this->isCsrfTokenValid('delete' . $sms->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sms);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sms_index');
    }
}
