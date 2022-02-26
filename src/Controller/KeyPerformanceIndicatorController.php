<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Entity\KeyPerformanceIndicator;
use App\Entity\Objective;
use App\Entity\Perspective;
use App\Entity\Strategy;
use App\Form\KeyPerformanceIndicatorType;
use App\Helper\Helper;
use App\Repository\KeyPerformanceIndicatorRepository;
use Knp\Component\Pager\PaginatorInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/key_performance_indicator")
 */
class KeyPerformanceIndicatorController extends AbstractController
{
    /**
     * @Route("/", name="key_performance_indicator_index")
     */
    public function index(Request $request, KeyPerformanceIndicatorRepository $keyPerformanceIndicatorRepository, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('vw_kpi');
        $keyPerformanceIndicator = new KeyPerformanceIndicator();
        $form = $this->createForm(KeyPerformanceIndicatorType::class, $keyPerformanceIndicator);
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
            ->add('strategy', EntityType::class, [
                'class' => Strategy::class,
                'multiple' => true,
                'required' => false,

            ])
            ->getForm();
        $filterform->handleRequest($request);
        $locales = Helper::locales();
        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($locales as $key => $value) {
                $keyPerformanceIndicator->translate($value)->setName($request->request->get('key_performance_indicator')[$value]);

                $keyPerformanceIndicator->translate($value)->setDescription($request->request->get('key_performance_indicator')[$value . "description"]);
            }
            $keyPerformanceIndicator->setCreatedAt(new \DateTime());
            $keyPerformanceIndicator->setIsActive(1);
            $keyPerformanceIndicator->setCreatedBy($this->getUser());
            $entityManager->persist($keyPerformanceIndicator);
            $keyPerformanceIndicator->mergeNewTranslations();
            $entityManager->flush();
            $this->addFlash('success', 'new key performance indicator is registered successfuly');

            return $this->redirectToRoute('key_performance_indicator_index');
        }

        if ($request->request->get('deactive')) {
            $this->denyAccessUnlessGranted('deact_kpi');
            $keyPerformanceIndicator = $keyPerformanceIndicatorRepository->find($request->request->get('deactive'));
            $keyPerformanceIndicator->setIsActive(false);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "deactivated successfuly");
            return $this->redirectToRoute('key_performance_indicator_index');
        }
        if ($request->request->get('active')) {
            $this->denyAccessUnlessGranted('act_kpi');
            $keyPerformanceIndicator = $keyPerformanceIndicatorRepository->find($request->request->get('active'));
            $keyPerformanceIndicator->setIsActive(true);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "activated successfuly");
            return $this->redirectToRoute('key_performance_indicator_index');
        }



        if ($filterform->isSubmitted() && $filterform->isValid()) {
            $keyPerformanceIndicators = $keyPerformanceIndicatorRepository->search($filterform->getData());
        } elseif ($request->query->get('search')) {
            $keyPerformanceIndicators = $keyPerformanceIndicatorRepository->search(['name' => $request->query->get('search')]);
        } else

            $keyPerformanceIndicators = $keyPerformanceIndicatorRepository->findAlls();

        $data = $paginator->paginate(
            $keyPerformanceIndicators,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('key_performance_indicator/index.html.twig', [
            'key_performance_indicators' => $data,

            'form' => $form->createView(),
            'filterform' => $filterform->createView(),

        ]);
    }
    /**
     * @Route("/excel", name="excel_kpi", methods={"GET","POST"})
     */

    public function excel(Request $request, PaginatorInterface $paginator, KeyPerformanceIndicatorRepository $keyPerformanceIndicatorRepository)
    {
        $session = new Session();
        // $em = $this->getDoctrine()->getManager();
        $entityManager = $this->getDoctrine()->getManager();
        // if ($session->get('filter')) {

        //     $initiativestotal  = $initiativeRepository->search($session->get('filter'))->getResult();
        // } else
        $initiativestotal = $keyPerformanceIndicatorRepository->findAll();


        $spreadsheet = new Spreadsheet();
        foreach (range('A', 'F') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'KPI Number');
        $sheet->setCellValue('B1', 'KPI Name');
        $sheet->setCellValue('C1', 'OBJECTIVE');
        $sheet->setCellValue('D1', 'Weight');
        $sheet->setCellValue('E1', 'IsActive');

        $totalResult = $initiativestotal;
        // dd($totalResult);
        $x = 2;
        $soh = 0;
        foreach ($totalResult as $result) {
            $sheet->setCellValue('A' . $x, $result->getKpiNumber());
            $sheet->setCellValue('B' . $x, $result->getName());
            $sheet->setCellValue('C' . $x, $result->getObjective()->getName());
            $sheet->setCellValue('D' . $x, $result->getWeight());
            $sheet->setCellValue('E' . $x, $result->getIsActive());


            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = "Kpi" . '.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }

    /**
     * @Route("/new", name="key_performance_indicator_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ad_kpi');
        $keyPerformanceIndicator = new KeyPerformanceIndicator();
        $form = $this->createForm(KeyPerformanceIndicatorType::class, $keyPerformanceIndicator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($keyPerformanceIndicator);
            $entityManager->flush();

            return $this->redirectToRoute('key_performance_indicator_index');
        }

        return $this->render('key_performance_indicator/new.html.twig', [
            'key_performance_indicator' => $keyPerformanceIndicator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="key_performance_indicator_show", methods={"GET"})
     */
    public function show(KeyPerformanceIndicator $keyPerformanceIndicator): Response
    {
        $this->denyAccessUnlessGranted('vw_kpi_dtl');
        return $this->render('key_performance_indicator/show.html.twig', [
            'key_performance_indicator' => $keyPerformanceIndicator,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="key_performance_indicator_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, KeyPerformanceIndicator $keyPerformanceIndicator): Response
    {
        $this->denyAccessUnlessGranted('edt_kpi');
        $form = $this->createForm(KeyPerformanceIndicatorType::class, $keyPerformanceIndicator);
        $form->handleRequest($request);
        $locales = Helper::locales();
        if ($form->isSubmitted()) {

            foreach ($locales as $key => $value) {
                $keyPerformanceIndicator->translate($value)->setName($request->request->get('key_performance_indicator')[$value]);

                $keyPerformanceIndicator->translate($value)->setDescription($request->request->get('key_performance_indicator')[$value . "description"]);
            }
            $keyPerformanceIndicator->mergeNewTranslations();
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "Edited successfuly");


            return $this->redirectToRoute('key_performance_indicator_index');
        }

        return $this->render('key_performance_indicator/edit.html.twig', [
            'key_performance_indicator' => $keyPerformanceIndicator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="key_performance_indicator_delete", methods={"DELETE"})
     */
    public function delete(Request $request, KeyPerformanceIndicator $keyPerformanceIndicator): Response
    {
        $this->denyAccessUnlessGranted('dlt_kpi');
        if ($this->isCsrfTokenValid('delete' . $keyPerformanceIndicator->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($keyPerformanceIndicator);
            $entityManager->flush();
            $this->addFlash('danger', 'KPI Delete Successifull  !');
        }

        return $this->redirectToRoute('key_performance_indicator_index');
    }
}
