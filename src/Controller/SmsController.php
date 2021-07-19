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
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sms")
 */
class SmsController extends AbstractController
{
    /**
     * @Route("/", name="sms_index", methods={"GET"})
     */
    public function index(SmsRepository $smsRepository): Response
    {
        return $this->render('sms/index.html.twig', [
            'sms' => $smsRepository->findAll(),
        ]);
    }
//   /**
//      * @Route("/sms", name="sms_send")
//      */
//     public function smsSend(Request $request, SmsHelper $smsHelper)
//     {
//         // $this->denyAccessUnlessGranted('sms_send');

//         $em = $this->getDoctrine()->getManager();
//         $filterform = $this->createFormBuilder()

//             ->add('principalOffice', EntityType::class, [
//                 'class' => PrincipalOffice::class,
//                 'multiple' => true,
//                 'required' => true
//             ])
//             ->add('operationalOffice', EntityType::class, [
//                 'class' => OperationalOffice::class,
//                 'multiple' => true,
//                 'required' => true
//             ])
//               ->add('performer', EntityType::class, [
//                 'class' => UserInfo::class,
//                 'multiple' => true,
//                 'required' => true
//             ])
        
//             ->add('text', TextType::class, [

//                 'required' => false
//             ])
//             ->getForm();
//         $filterform->handleRequest($request);

//         if ($filterform->isSubmitted() && $filterform->isValid()) {
//             // $operationalOffice= $filterform->getData([]);
//             $data = $filterform->getData();
          
//         }
// //             // $entityManager = $this->getDoctrine()->getManager();
// //           $message="2014 Plan Created ";
// //           $userInfo="0923707888";
// //   $smsHelper->sendSms("Account Update ", $message, '["' . $userInfo . '"]');

// //             $this->addFlash('success',"planning year is created successfuly");

//             // return $this->redirectToRoute('planning_year_index');
//         return $this->render('sms/index.html.twig', [
//             'filterform' => $filterform->createView(),
//         ]);
        
        

     
//     }
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
        if ($this->isCsrfTokenValid('delete'.$sms->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sms);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sms_index');
    }
}
