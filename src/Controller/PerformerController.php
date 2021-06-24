<?php

namespace App\Controller;

use App\Entity\OperationalOffice;
use App\Entity\Performer;
use App\Entity\StaffType;
use App\Form\PerformerType;
use App\Repository\PerformerRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/performer")
 */
class PerformerController extends AbstractController
{
    /**
     * @Route("/", name="performer_index", methods={"GET","POST"})
     */
    public function index(PerformerRepository $performerRepository,Request $request,PaginatorInterface $paginator): Response
    {
         $this->denyAccessUnlessGranted('vw_prfm');
        $performer = new Performer();
        $form = $this->createForm(PerformerType::class, $performer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                     $this->denyAccessUnlessGranted('ad_prfm');

            $entityManager = $this->getDoctrine()->getManager();
            $isActivePrincipal=$performerRepository->findActive($performer->getOperationalOffice(),$performer->getPerformer());
               if ($isActivePrincipal) {
                  $this->addFlash('danger',"performer is already assigned");

                     return $this->redirectToRoute('performer_index');
                  }
            $entityManager->persist($performer);
            $entityManager->flush();

            return $this->redirectToRoute('performer_index');
        }
         if($request->request->get('deactive')){
                      $this->denyAccessUnlessGranted('deact_prfm');

             $performer=$performerRepository->find($request->request->get('deactive'));
             $performer->setIsActive(false);
              $this->getDoctrine()->getManager()->flush();
               $this->addFlash('success',"deactivated successfuly");
              return $this->redirectToRoute('performer_index');
           
        }
          if($request->request->get('active')){
                       $this->denyAccessUnlessGranted('act_prfm');

             $performer=$performerRepository->find($request->request->get('active'));
           
              
             $performer->setIsActive(true);
              $this->getDoctrine()->getManager()->flush();
               $this->addFlash('success',"activated successfuly");
              return $this->redirectToRoute('performer_index');
           
         }
         
         $data=$paginator->paginate(
             $performerRepository->findAll(),
             $request->query->getInt('page',1),
             10

        );

        return $this->render('performer/index.html.twig', [
            'performers' => $data,
            'form'=> $form->createView()

        ]);
    }
      /**
     * @Route("/choose", name="choose_office")
     */
    public function choose(Request $request,UserRepository $userRepository)
    {
 $em=$this->getDoctrine()->getManager();
         $filterform = $this->createFormBuilder()
            ->add('operationalOffice', EntityType::class, [
                'class' => OperationalOffice::class,
                // 'multiple' => true,
                'required' => true
            ])  
              ->add('stafType', EntityType::class, [
                'class' => StaffType::class,
                // 'multiple' => true,
                'required' => true
            ])          
             ->getForm();
              $filterform->handleRequest($request);

        if ($filterform->isSubmitted() && $filterform->isValid()) {
            $operationalOffice= $filterform->getData([]);
            $data=$filterform->getData();
            $stafType=$data['stafType'];

            $this->getUser();
            $operationalOffices=$operationalOffice['operationalOffice'];
            $performer=new Performer();
            $performer->setOperationalOffice($operationalOffices);
            $performer->setPerformer($this->getUser());
           $users= $userRepository->find($this->getUser()->getId());
                   $users->setStaffType($stafType);
           $users->setStatus(1);
            $em->persist($performer);
            $em->flush();
          return $this->redirectToRoute('startegic_plan');
        }
          return $this->render('performer/chooseOffice.html.twig', [
            'filterform' => $filterform->createView(),
        ]);}
    /**
     * @Route("/new", name="performer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ad_prfm');

        $performer = new Performer();
        $form = $this->createForm(PerformerType::class, $performer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($performer);
            $entityManager->flush();

            return $this->redirectToRoute('performer_index');
        }

        return $this->render('performer/new.html.twig', [
            'performer' => $performer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="performer_show", methods={"GET"})
     */
    public function show(Performer $performer): Response
    {
                 $this->denyAccessUnlessGranted('vw_prfm_dtl');

        return $this->render('performer/show.html.twig', [
            'performer' => $performer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="performer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Performer $performer): Response
    {
                 $this->denyAccessUnlessGranted('edt_prfm');

        $form = $this->createForm(PerformerType::class, $performer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('performer_index');
        }

        return $this->render('performer/edit.html.twig', [
            'performer' => $performer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="performer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Performer $performer): Response
    {
                 $this->denyAccessUnlessGranted('dlt_prfm');

        if ($this->isCsrfTokenValid('delete'.$performer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($performer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('performer_index');
    }
}
