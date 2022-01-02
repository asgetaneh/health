<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Entity\Initiative;
use App\Entity\InitiativeAttribute;
use App\Entity\InitiativeCategory;
use App\Entity\KeyPerformanceIndicator;
use App\Entity\Objective;
use App\Entity\Perspective;
use App\Entity\PrincipalOffice;
use App\Entity\Strategy;
use App\Form\InitiativeType;
use App\Helper\Helper;
use App\Repository\InitiativeRepository;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @Route("/initiative")
 */
class InitiativeController extends AbstractController
{
    /**
     * @Route("/", name="initiative_index", methods={"GET","POST"})
     */
    public function index(InitiativeRepository $initiativeRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('vw_intv');

        $initiative = new Initiative();
        $form = $this->createForm(InitiativeType::class, $initiative);
        $form->handleRequest($request);
        $locales = Helper::locales();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($locales as $key => $value) {
                $initiative->translate($value)->setName($request->request->get('initiative')[$value]);

                $initiative->translate($value)->setDescription($request->request->get('initiative')[$value . "description"]);
            }
            $initiative->setCreatedAt(new DateTime('now'));
            $initiative->setCreatedBy($this->getUser());
            $entityManager->persist($initiative);
            $initiative->mergeNewTranslations();
            $entityManager->flush();

            $this->addFlash('success', "initatives are added seccussfuly");
            return $this->redirectToRoute('initiative_index');
        }
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
            ->add('kpi', EntityType::class, [
                'class' => KeyPerformanceIndicator::class,
                'multiple' => true,
                'required' => false,

            ])
            ->add('principaloffice', EntityType::class, [
                'class' => PrincipalOffice::class,
                'multiple' => true,
                'required' => false,

            ])
            ->add('category', EntityType::class, [
                'class' => InitiativeCategory::class,
                'multiple' => true,
                'required' => false,

            ])
            ->add('coreTask', ChoiceType::class, [
                'choices'  => [
                    'Choose ' => null,
                    'Assign' => 1,
                    'Not Assign' => 0,
                ],
            ])
            ->getForm();




        if ($request->request->get('deactive')) {
            $this->denyAccessUnlessGranted('deact_intv');

            $initiatives = $initiativeRepository->find($request->request->get('deactive'));
            $initiatives->setIsActive(false);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "deactivated successfuly");
            return $this->redirectToRoute('initiative_index');
        }
        if ($request->request->get('active')) {
            $this->denyAccessUnlessGranted('act_intv');

            $initiatives = $initiativeRepository->find($request->request->get('active'));
            $initiatives->setIsActive(true);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "activated successfuly");
            return $this->redirectToRoute('initiative_index');
        }

        $filterform->handleRequest($request);
        $session = new Session();
        $session->remove('filter');

        if ($filterform->isSubmitted() && $filterform->isValid()) {
            $session->set('filter', $filterform->getData());
            $initiatives = $initiativeRepository->search($filterform->getData());
        } elseif ($request->query->get('search')) {
            $session->set('filter', ['name' => $request->query->get('search')]);
            $initiatives = $initiativeRepository->search(['name' => $request->query->get('search')]);
        } else
            $initiatives = $initiativeRepository->findAlls();
        $initiativestotal = $initiativeRepository->findAll();

        $data = $paginator->paginate(
            $initiatives,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('initiative/index.html.twig', [
            'initiatives' => $data,
            'initiativestotal' => $initiativestotal,
            'form' => $form->createView(),
            'filterform' => $filterform->createView(),
        ]);
    }

    /**
     * @Route("/new", name="initiative_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ad_intv');

        $initiative = new Initiative();
        $form = $this->createForm(InitiativeType::class, $initiative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($initiative);
            $entityManager->flush();

            return $this->redirectToRoute('initiative_index');
        }

        return $this->render('initiative/new.html.twig', [
            'initiative' => $initiative,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/excel", name="excel_initiative", methods={"GET","POST"})
     */

    public function excel(Request $request, PaginatorInterface $paginator, InitiativeRepository $initiativeRepository)
    {
        $session = new Session();
        // $em = $this->getDoctrine()->getManager();
        $entityManager = $this->getDoctrine()->getManager();
        if ($session->get('filter')) {

            $initiativestotal  = $initiativeRepository->search($session->get('filter'))->getResult();
        } else
            $initiativestotal = $initiativeRepository->findAll();


        $spreadsheet = new Spreadsheet();
        foreach (range('A', 'E') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Initiative Number');
        $sheet->setCellValue('B1', 'Initiative Name');
        $sheet->setCellValue('C1', 'Kpi');
        $sheet->setCellValue('D1', 'Weight');
        $sheet->setCellValue('E1', 'Behaviour');

        $totalResult = $initiativestotal;
        // dd($totalResult);
        $x = 2;
        $soh = 0;
        foreach ($totalResult as $result) {
            $sheet->setCellValue('A' . $x, $result->getInitiativeNumber());
            $sheet->setCellValue('B' . $x, $result->getName());
            $sheet->setCellValue('C' . $x, $result->getKeyPerformanceIndicator()->getName());
            $sheet->setCellValue('D' . $x, $result->getWeight());
            $sheet->setCellValue('E' . $x, $result->getInitiativeBehaviour());

            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = "Initiatives" . '.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }
    /**
     * @Route("/printes", name="print_initiative", methods={"GET","POST"})
     */

    public function print(Request $request, PaginatorInterface $paginator, InitiativeRepository $initiativeRepository)
    {
        set_time_limit(120);


        $session = new Session();
        // $em = $this->getDoctrine()->getManager();
        $entityManager = $this->getDoctrine()->getManager();
        if ($session->get('filter')) {

            $initiativestotal  = $initiativeRepository->search($session->get('filter'))->getResult();
        } else {
            $initiativestotal = $initiativeRepository->findAll();
        }
        $count = 0;
        foreach ($initiativestotal as $initiative) {
            $count++;
        }

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($pdfOptions);
        $c = 0;

        $start = '<html>
                            <head>
                            <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <style>

                table{

                border-collapse:collapse;
                width:80% !important;
                font-size:12px;
                font-family:"times-new-roman";



                }
               
                </style>
                            </head>
                            <body> 
                           
                            
                            ';
        $body  = '<center><h3 >Ju Initiative   </h3></center>Total : ' . $count . ' <br/>';
        $table = '    
                    <table border="1" >
                    <thead>
                        <tr >
                            <th width="10">#</th>
                            <th width="20">Initiative</th>
                            	<th>KPI</th>
										<th>Objective</th>
										<th>Goal</th>
                         <th width="15">Initiative Behaviour</th>
                            <th width="45">Principal Office</th>
                            <th width="15">Weight</th>
                              <th width="5">Initiative Category</th>

                            
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($initiativestotal as $initiative) {

            $c += 1;
            $table .= '<tr><td>' . $c . '</td><td> ' . $initiative->getName() . '</td><td>' . $initiative->getKeyPerformanceIndicator() . '</td>
            <td>' . $initiative->getKeyPerformanceIndicator()->getStrategy()->getObjective() . '</td>
            <td>' . $initiative->getKeyPerformanceIndicator()->getStrategy()->getObjective()->getGoal() . '</td>
            <td> ' . $initiative->getInitiativeBehaviour() . '</td><td>';
            $count = 0;
            foreach ($initiative->getPrincipalOffice() as $office) {
                $count += 1;
                $table .= '<p>' . $count . ',' .
                    $office . '</p>';
            }



            $table .= '</td><td> ' . $initiative->getWeight() . '</td>
<td> ' . $initiative->getCategory() . '</td>
             </tr>';
        }

        $table .= ' </tbody></table>';
        $end = '</body></html>';
        // return new Response($start . $body . $table . $end);
        $dompdf->loadHtml($start . $body . $table . $end);

        $pdfOptions->setIsHtml5ParserEnabled(true);

        $dompdf->setPaper('A4', 'Landscape');

        $dompdf->render();
        $dompdf->stream("juinitiative.pdf", [
            "Attachment" => false
        ]);
        return $this->redirectToRoute('initiative_index');
    }

    /**
     * @Route("/{id}", name="initiative_show", methods={"GET"})
     */
    public function show(Initiative $initiative): Response
    {
        $this->denyAccessUnlessGranted('vw_intv_dtl');

        return $this->render('initiative/show.html.twig', [
            'initiative' => $initiative,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="initiative_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Initiative $initiative): Response
    {
        $this->denyAccessUnlessGranted('edt_intv');

        $form = $this->createForm(InitiativeType::class, $initiative);
        $form->handleRequest($request);
        $locales = Helper::locales();

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($locales as $key => $value) {
                $initiative->translate($value)->setName($request->request->get('initiative')[$value]);

                $initiative->translate($value)->setDescription($request->request->get('initiative')[$value . "description"]);
            }
            $initiative->mergeNewTranslations();

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "edited successfuly");

            return $this->redirectToRoute('initiative_index');
        }

        return $this->render('initiative/edit.html.twig', [
            'initiative' => $initiative,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Initiative $initiative): Response
    {
        $this->denyAccessUnlessGranted('dlt_intv');

        if ($this->isCsrfTokenValid('delete' . $initiative->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($initiative);
            $entityManager->flush();
        }

        return $this->redirectToRoute('initiative_index');
    }
}
