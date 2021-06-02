<?php

namespace App\Controller;

use App\Entity\Objective;
use App\Entity\Perspective;
use App\Entity\Goal;
use App\Form\ObjectiveType;
use App\Helper\Helper;
use App\Repository\ObjectiveRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/objective")
 */
class ObjectiveController extends AbstractController
{
    /**
     * @Route("/", name="objective_index")
     */
    public function index(Request $request,PaginatorInterface $paginator, ObjectiveRepository $objectiveRepository): Response
    {
        $objective = new Objective();
        $form = $this->createForm(ObjectiveType::class, $objective);
        $form->handleRequest($request);
         $filterform=$this->createFormBuilder()
         ->add('goal',EntityType::class,[
             'class'=>Goal::class,
             'multiple'=>true,
             'required'=>false,
         ])
         ->add('perspective',EntityType::class,[
             'class'=>Perspective::class,
              'multiple'=>true,
              'required'=>false,

         ])
         ->getForm();
         $filterform->handleRequest($request);
         $locales=Helper::locales();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
             foreach ($locales as $key => $value) {
               $objective->translate($value)->setName($request->request->get('objective')[$value]);
               $objective->translate($value)->setOutPut($request->request->get('objective')[$value]);
               $objective->translate($value)->setOutCome($request->request->get('objective')[$value]);
               $objective->translate($value)->setDescription($request->request->get('objective')[$value]);
            }
            $objective->setCreatedAt(new \DateTime());
            $objective->setIsActive(1);
            $objective->setCreatedBy($this->getUser());
            $entityManager->persist($objective);
             $objective->mergeNewTranslations();
            $entityManager->flush();
            $this->addFlash('success',"objective is registered successfuly");
            return $this->redirectToRoute('objective_index');
        }

    if ($request->request->get('deactive')) {
            $objective = $objectiveRepository->find($request->request->get('deactive'));
            $objective->setIsActive(false);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "deactivated successfuly");
           return $this->redirectToRoute('objective_index');
        }
        if ($request->request->get('active')) {
            $objective = $objectiveRepository->find($request->request->get('active'));
            $objective->setIsActive(true);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "activated successfuly");
           return $this->redirectToRoute('objective_index');
        }


        if($filterform->isSubmitted() && $filterform->isValid()){
            $objectives=$objectiveRepository->search($filterform->getData()); 
        }
        elseif ($request->request->get('search')) {
            $objectives=$objectiveRepository->search(['name'=>$request->request->get('search')]); 
        }
        else
      $objectives=$objectiveRepository->findAlls(); 
      

        
       
        $data = $paginator->paginate(
            $objectives,
            $request->query->getInt('page', 1),
            10
        );     
           return $this->render('objective/index.html.twig', [
            'objectives' => $data,
            
            'form' => $form->createView(),
            'filterform'=>$filterform->createView()

        ]);
      
    }

    /**
     * @Route("/new", name="objective_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $objective = new Objective();
        $form = $this->createForm(ObjectiveType::class, $objective);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($objective);
            $entityManager->flush();

            return $this->redirectToRoute('objective_index');
        }

        return $this->render('objective/new.html.twig', [
            'objective' => $objective,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objective_show", methods={"GET"})
     */
    public function show(Objective $objective): Response
    {
        return $this->render('objective/show.html.twig', [
            'objective' => $objective,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="objective_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Objective $objective): Response
    {
        $form = $this->createForm(ObjectiveType::class, $objective);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('objective_index');
        }

        return $this->render('objective/edit.html.twig', [
            'objective' => $objective,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objective_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Objective $objective): Response
    {
        if ($this->isCsrfTokenValid('delete'.$objective->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($objective);
            $entityManager->flush();
        }

        return $this->redirectToRoute('objective_index');
    }
}
