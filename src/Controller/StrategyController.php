<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Goal;
use App\Entity\Objective;
use App\Entity\Perspective;
use App\Entity\Strategy;
use App\Form\StrategyType;
use App\Helper\Helper;
use App\Repository\StrategyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/strategy")
 */
class StrategyController extends AbstractController
{
    /**
     * @Route("/", name="strategy_index")
     */
    public function index(Request $request, StrategyRepository $strategyRepository, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('vw_str');
        $strategy = new Strategy();
        $form = $this->createForm(StrategyType::class, $strategy);
        $form->handleRequest($request);


        $filterform = $this->createFormBuilder()
            ->setMethod('Get')
            ->add('goal', EntityType::class, [
                'class' => Goal::class,
                'multiple' => true,
                'required' => false
            ])
            ->add('objective', EntityType::class, [
                'class' => Objective::class,
                'multiple' => true,
                'required' => false

            ])
            ->add('perspective', EntityType::class, [
                'class' => Perspective::class,
                'multiple' => true,
                'required' => false,

            ])
            
            ->getForm();
        $filterform->handleRequest($request);

        $locales = Helper::locales();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($locales as $key => $value) {
                $strategy->translate($value)->setName($request->request->get('strategy')[$value]);

                $strategy->translate($value)->setDescription($request->request->get('strategy')[$value . "description"]);
            }
            $strategy->setCreatedAt(new \DateTime());
            $strategy->setIsActive(1);
            $strategy->setCreatedBy($this->getUser());
            $entityManager->persist($strategy);
            $strategy->mergeNewTranslations();
            $entityManager->flush();
            $this->addFlash('success', 'new strategy is registered successfuly');
            return $this->redirectToRoute('strategy_index');
        }


        if ($request->request->get('deactive')) {
            $this->denyAccessUnlessGranted('deact_str');
            $strategy = $strategyRepository->find($request->request->get('deactive'));
            $strategy->setIsActive(false);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "deactivated successfuly");
            return $this->redirectToRoute('strategy_index');
        }
        if ($request->request->get('active')) {
            $this->denyAccessUnlessGranted('act_str');
            $strategy = $strategyRepository->find($request->request->get('active'));
            $strategy->setIsActive(true);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "activated successfuly");
            return $this->redirectToRoute('strategy_index');
        }




        if ($filterform->isSubmitted() && $filterform->isValid()) {
            $strategies = $strategyRepository->search($filterform->getData());
        } elseif ($request->query->get('search')) {
            $strategies = $strategyRepository->search(['name' => $request->query->get('search')]);
        } else

            $strategies = $strategyRepository->findAlls();
        $data = $paginator->paginate(
            $strategies,
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('strategy/index.html.twig', [
            'strategies' => $data,

            'form' => $form->createView(),
            'filterform' => $filterform->createView(),


        ]);
    }

    /**
     * @Route("/new", name="strategy_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $strategy = new Strategy();
        $form = $this->createForm(StrategyType::class, $strategy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($strategy);
            $entityManager->flush();

            return $this->redirectToRoute('strategy_index');
        }

        return $this->render('strategy/new.html.twig', [
            'strategy' => $strategy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="strategy_show", methods={"GET"})
     */
    public function show(Strategy $strategy): Response
    {
        $this->denyAccessUnlessGranted('vw_str_dtl');
        return $this->render('strategy/show.html.twig', [
            'strategy' => $strategy,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="strategy_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Strategy $strategy): Response
    {
        $this->denyAccessUnlessGranted('edt_str');
        $form = $this->createForm(StrategyType::class, $strategy);
        $form->handleRequest($request);
        $locales = Helper::locales();
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($locales as $key => $value) {
                $strategy->translate($value)->setName($request->request->get('strategy')[$value]);
                $strategy->translate($value)->setDescription($request->request->get('strategy')[$value . "description"]);
            }
            
            $this->getDoctrine()->getManager()->persist($strategy);
            $strategy->mergeNewTranslations();
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', ' edited successfuly');

            return $this->redirectToRoute('strategy_index');
        }

        return $this->render('strategy/edit.html.twig', [
            'strategy' => $strategy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="strategy_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Strategy $strategy): Response
    {
        $this->denyAccessUnlessGranted('dlt_str');
        if ($this->isCsrfTokenValid('delete' . $strategy->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($strategy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('strategy_index');
    }
}
