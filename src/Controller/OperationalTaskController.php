<?php

namespace App\Controller;


use App\Entity\OperationalTask;
use App\Entity\Performer;
use App\Entity\PerformerTask;
use App\Entity\PlanningAccomplishment;
use App\Entity\StaffEvaluationBehaviorCriteria;
use App\Entity\SuitableInitiative;
use App\Entity\TaskMeasurement;
use App\Form\OperationalTaskType;
use App\Form\PerformerTaskType;
use App\Form\TaskMeasurementType;
use App\Repository\OperationalManagerRepository;
use App\Repository\OperationalOfficeRepository;
use App\Repository\OperationalTaskRepository;
use App\Repository\PerformerRepository;
use App\Repository\PerformerTaskRepository;
use App\Repository\PlanningAccomplishmentRepository;
use App\Repository\PlanRepository;
use App\Repository\PrincipalOfficeRepository;
use App\Repository\StaffEvaluationBehaviorCriteriaRepository;
use App\Repository\SuitableInitiativeRepository;
use App\Repository\TaskAccomplishmentRepository;
use App\Repository\TaskAssignRepository;
use App\Repository\TaskMeasurementRepository;
use App\Repository\TaskUserRepository;
use App\Repository\UserInfoRepository;
use DateTime;
use Andegna\DateTime as AD;
use Andegna\DateTimeFactory;
use App\Entity\Delegation;
use App\Entity\Evaluation;
use App\Entity\Initiative;
use App\Entity\OperationalPlanningAccomplishment;
use App\Entity\OperationalSuitableInitiative;
use App\Entity\PlanningYear;
use App\Entity\PrincipalOffice;
use App\Entity\SmisSetting;
use App\Entity\SuitableOperational;
use App\Entity\TaskAssign;
use App\Entity\TaskUser;
use App\Entity\User;
use App\Helper\AmharicHelper;
use App\Helper\Helper;
use App\Repository\OperationalPlanningAccomplishmentRepository;
use App\Repository\OperationalSuitableInitiativeRepository;
use App\Repository\PlanningQuarterRepository;
use App\Repository\PrincipalManagerRepository;
use Container5yVdKyl\getOperationalPlanningAccomplishmentRepositoryService;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\PaginatorInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Proxies\__CG__\App\Entity\InitiativeAttribute;
use Proxies\__CG__\App\Entity\PlanningQuarter;
use Proxies\__CG__\App\Entity\SuitableOperational as EntitySuitableOperational;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operational_task")
 */
class OperationalTaskController extends AbstractController
{

    /**
     * @Route("/index/{id}", name="operational_task_index")
     */
    public function index(Request $request, SuitableOperational $suitableOperational, OperationalPlanningAccomplishmentRepository $operationalPlanningAccomplishmentRepository,  PerformerTaskRepository $performerTaskRepository): Response
    {
        $this->denyAccessUnlessGranted('opr_task');
        //create task 
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user, 'status' => 1]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
        }
        $social = 0;
        foreach ($suitableOperational->getSuitableInitiative()->getInitiative()->getSocialAtrribute() as $va) {
            if ($va->getName()) {
                $social = 1;
            }
        }
        $performerTask = new PerformerTask();
        $form = $this->createForm(PerformerTaskType::class, $performerTask);
        $form->handleRequest($request);
        $taskMeasurement = new TaskMeasurement();
        $formtask = $this->createForm(TaskMeasurementType::class, $taskMeasurement);
        $formtask->handleRequest($request);
        $count = 0;
        $maxcount = 0;
        $operationalTasks = $performerTaskRepository->findPerformerInitiativeTask($user, $suitableOperational);
        $taskAssigns = $em->getRepository(TaskAssign::class)->findTaskUsers($user);
        foreach ($operationalTasks as $operationals) {
            $count = $count +
                $operationals->getWeight();
            $maxcount++;
        }
        $time = new DateTime('now');
        $quarterId = 0;
        $quarterName = 0;
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        foreach ($quarters as $quarter) {
            if ($time >= $quarter->getStartDate() && $time <= $quarter->getEndDate()) {

                $quarterId = $quarter->getId();
                $quarterName = $quarter->getName();
                $quarterStartMonth1 = $quarter->getStartMonth();
                $quarterStartDate1 = $quarter->getStartDay();
                $quarterEndMonth = $quarter->getEndMonth();
                $quarterStartDate = AmharicHelper::getCurrentDay();
                $quarterEndDate = $quarter->getEndDay();
                $startYear = AmharicHelper::getCurrentYear();
                $endYear = $quarter->getEndDate();
                $endYear = AmharicHelper::getCurrentYearPara($endYear);
                $quarterStartMonth = AmharicHelper::getCurrentMonth();
                $quarterStartMonth = explode('-', $quarterStartMonth);
                $maxDate = $endYear . ',' . $quarterEndMonth . ',' . $quarterEndDate;
                $maxDate = $endYear . ',' . $quarterEndMonth . ',' . $quarterEndDate;
                $minDate = $startYear . ',' . $quarterStartMonth[1] . ',' . $quarterStartDate;
                $maxDate = $endYear . ',' . $quarterEndMonth . ',' . $quarterEndDate;
                $minDateEdit = $startYear . ',' . $quarterStartMonth1 . ',' . $quarterStartDate1;
            }
        }
        $maxContengencyTimes = $em->getRepository(SmisSetting::class)->findOneBy(['code' => 1]);
        $maxTasks = $em->getRepository(SmisSetting::class)->findOneBy(['code' => 2]);
        $maxTask = $maxTasks->getValue();
        $maxContengencyTime = $maxContengencyTimes->getValue();
        if ($form->isSubmitted() && $form->isValid()) {
            if ($social == 1) {
                $plans = $operationalPlanningAccomplishmentRepository->findBy(['operationalSuitable' => $suitableOperational, 'quarter' => $quarterId]);
            } else {
                $plans = $operationalPlanningAccomplishmentRepository->findBy(['operationalSuitable' => $suitableOperational, 'quarter' => $quarterId]);
            }
            if (!$plans) {
                $this->addFlash('danger', 'Plan Not Set for this Initiative');
                return $this->redirectToRoute('operational_task_index', ['id' => $suitableOperational->getId()]);
            }
            // dd($plans);
            $performerTask->setOperationalPlanningAcc($plans[0]);
            if ($social == 1) {
                $performerTask->setOperationalPlanningAccSocial($plans[1]);
            }
            $performerTask->setStatus(1);
            if ($delegatedUser) {
                $delegatedBy = $delegatedUser->getDelegatedUser();
                $performerTask->setDeligateBy($delegatedBy);
            }
            $performerTask->setQuarter($em->getRepository(PlanningQuarter::class)->find($quarterId));
            foreach ($user->getOperationalManagers() as $op) {
                $opOff = $op->getOperationalOffice();
            }
            if ($maxcount > $maxTask) {
                $this->addFlash('danger', 'Task must be less than 7 !');
                return $this->redirectToRoute('operational_task_index', ['id' => $suitableOperational->getId()]);
            }
            $performerTask->setOperationalOffice($opOff);
            $performerTask->setCreatedBy($user);
            $weight = $form->getData()->getWeight();
            if ($count + $weight > 100) {
                $this->addFlash('danger', 'Weight must be less than 100 !');
                return $this->redirectToRoute('operational_task_index', ['id' => $suitableOperational->getId()]);
            }
            $em->persist($performerTask);
            $em->flush();
            $this->addFlash('success', ' Task Created Successfully!');
            return $this->redirectToRoute('operational_task_index', ['id' => $suitableOperational->getId()]);
        }
        $count = 0;
        $operationalTasks = $performerTaskRepository->findPerformerInitiativeTask($user, $suitableOperational);
        foreach ($operationalTasks as $operationals) {
            $count = $count +
                $operationals->getWeight();
        }
        $maxContengencyTimes = $em->getRepository(SmisSetting::class)->findOneBy(['code' => 1]);
        $maxContengencyTime = $maxContengencyTimes->getValue();
        return $this->render('operational_task/index.html.twig', [
            'performerTasks' => $performerTaskRepository->findPerformerInitiativeTask($user, $suitableOperational),
            'countWeight' => $count,
            'quarterName' => $quarterName,
            'taskAssigns' => $taskAssigns,
            'form' => $form->createView(),
            'maxDate' => $maxDate,
            'maxContengencyTime' => $maxContengencyTime,
            'minDate' => $minDate,
            'minDateEdit' => $minDateEdit,
            'measurements' => $em->getRepository(TaskMeasurement::class)->findAll(),
            'social' => $social,
            'formtask' => $formtask->createView(),
            'initiativeName' => $suitableOperational->getSuitableInitiative()->getInitiative()->getName(),
        ]);
    }
    /**
     * @Route("/suitableInitiative_list", name="suitable_initiative_list")
     */
    public function suitableInitiative(Request $request, PaginatorInterface $paginator, OperationalManagerRepository $operationalManagerRepository): Response
    {
        $this->denyAccessUnlessGranted('opr_task');
        $em = $this->getDoctrine()->getManager();
        $uploadPlan = $this->createFormBuilder()
            ->add('uploadPlan', FileType::class, array(
                'attr' => array(
                    'id' => 'filePhoto',
                    // 'class' => 'sr-only',
                    //  'accept' => 'image/jpeg,image/png,image/jpg'
                ),
                'label' => '',


            ))
            ->getForm();


        $uploadPlan->handleRequest($request);

        if ($uploadPlan->isSubmitted() && $uploadPlan->isValid()) {

            $file = $uploadPlan['uploadPlan']->getData();
            // dd($uploadedFile);

            // $newFilename = $taskAc->getId() . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            // $uploadedFile->move($destination, $newFilename);

            $fileFolder = __DIR__ . '/../../public/plan/';  //choose the folder in which the uploaded file will be stored
            //  dd($file);
            $filePathName = md5(uniqid()) . $file->getClientOriginalName();
            //    dd($filePathName);
            // apply md5 function to generate an unique identifier for the file and concat it with the file extension  
            try {
                $file->move($fileFolder, $filePathName);
            } catch (FileException $e) {
                dd($e);
            }
            // dd($currentQuarter);
            $currentQuarter = $em->getRepository(PlanningQuarter::class)->findAll();
            $spreadsheet = IOFactory::load($fileFolder . $filePathName); // Here we are able to read from the excel file 
            $row = $spreadsheet->getActiveSheet()->removeRow(1); // I added this to be able to remove the first file line 
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // here, the read data is turned into an array
            //  dd($sheetData);    
            $operation = $operationalManagerRepository->findOneBy(['manager' => $this->getUser()]);
            $principal = $operation->getOperationalOffice()->getPrincipalOffice();
            $suitPri = $em->getRepository(SuitableInitiative::class)->findBy(['principalOffice' => $principal]);
            foreach ($sheetData as $keys => $values) {
                $su = $em->getRepository(SuitableInitiative::class)->finds($values['A'],$principal);
                // dd($su);
                foreach ($su as $key => $value) {
                    //  dd($value);
                    // if ($su[$key] == $value) {
                        $operSuitable = $em->getRepository(SuitableOperational::class)->findBy(['operationalOffice' => $operation->getOperationalOffice(), 'suitableInitiative' => $value]);
                        // if ($operSuitable) {
                        //     $this->addFlash('danger', ' Plan Already Done');
                        //     return $this->redirectToRoute('suitable_initiative_list');
                        // }
                        $operationalSui = new SuitableOperational();
                        $operationalSui->setSuitableInitiative($value);
                        $operationalSui->setOperationalOffice($operation->getOperationalOffice());
                        $em->persist($operationalSui);
                        for ($i = 0; $i < 4; $i++) {

                            $operationalplan = new OperationalPlanningAccomplishment();
                            $operationalplan->setOperationalSuitable($operationalSui);

                            $operationalplan->setQuarter($currentQuarter[$i]);
                            if ($i == 0) {
                                $planf = $values['C'];
                            } else if ($i == 1) {
                                $planf = $values['D'];
                            } else if ($i == 2) {
                                $planf = $values['D'];
                            } else {
                                $planf = $values['F'];
                            }
                            if ($planf) {
                                $operationalplan->setPlanValue($planf);
                            }
                            else{
                                $operationalplan->setPlanValue(0);
                            }
                            $em->persist($operationalplan);
                            $em->flush();
                        }
                    // }

                }
            }
            // dd($suitPri,$sheetData);
            foreach ($sheetData as $keys => $values) {
                // dump($values);
                $su = $em->getRepository(SuitableInitiative::class)->finds($values['A'], $principal);
                // dump($su);
                foreach ($su as $key => $value) {
                        $help = Helper::calculatePrincipalOfficePlan($em, $value);
                }
            }
           
                            // dd(1);


            // $this->calculatePrincipalOfficePlan($em, $planInitiative);

            $this->addFlash('success', ' Plan Uploaded Successfully');
            return $this->redirectToRoute('suitable_initiative_list');
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user, 'status' => 1]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
        }
        $social = 0;
        $currentYear = AmharicHelper::getCurrentYear();
        $operation = $operationalManagerRepository->findOneBy(['manager' => $user]);
        $operationalOffice =  $operation->getOperationalOffice()->getId();
        $currentQuarter = AmharicHelper::getCurrentQuarter($em);
        $currentMonths = AmharicHelper::getCurrentMonth($em);
        $currentMonths=explode('-', $currentMonths);

        if ($currentQuarter == 1) {
            $currentYear = $currentYear + 1;
            if ($currentMonths[1] == "01") {
            $currentYear = $currentYear - 1;

            }
        }
        $operationalSuitables = $em->getRepository(SuitableOperational::class)->findSuitableInitiatve($operationalOffice, $currentYear);
        $operationalPlanningAccomplishments = $em->getRepository(OperationalPlanningAccomplishment::class)->findAll();
        $data = $paginator->paginate(
            $operationalSuitables,
            $request->query->getInt('page', 1),
            10
        );
       
        return $this->render('operational_task/suitableInitiative.html.twig', [
            'operationalSuitables' => $data,
            'data'=>$operationalSuitables,
            'uploadPlan' => $uploadPlan->createView(),
            'count' => $operationalSuitables,
            'operationalPlanningAccomplishments' => $operationalPlanningAccomplishments,
            'quarter' => $currentQuarter = AmharicHelper::getCurrentQuarter($em)


        ]);
    }
     /**
     * @Route("/approve_operational_plan", name="approve_operational_plan")
     */
    public function approveOperationalPlan(Request $request)
    {
        // dd(1);

        $em = $this->getDoctrine()->getManager();

        $suitableInId = $request->request->get('suitableInId');
        $operationalOfId = $request->request->get('operationalOfId');

        $operationalSuitable = $em->getRepository(SuitableOperational::class)->findOperationalId($suitableInId,$operationalOfId);
        // dd($operationalSuitable);
        foreach ($operationalSuitable as  $value) {
        $value->setStatus(1);
        }
        $em->flush();
        return new JsonResponse($operationalSuitable);
    }
    
      /**
     * @Route("/operational_suitable_approve", name="operational_suitable_approve")
     */
    public function operationalSuitableapprove(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $operationalSuit = $request->request->get('operationalSui');
                dd($operationalSuit);

        $operationalSuitable = $em->getRepository(SuitableOperational::class)->find($operationalSuit);
                        dd($operationalSuitable);

        $operationalSuitable->setStatus(1);
        $em->flush();
        return new JsonResponse($operationalSuitable);
    }
    /**
     * @Route("/principal_report", name="principal_office_report", methods={"GET","POST"})
     */
    public function report(SuitableInitiativeRepository $suitableInitiativeRepository, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $principalOffice = $this->getUser()->getPrincipalManagers()[0]->getPrincipalOffice()->getId();
        $principalOfficeName = $this->getUser()->getPrincipalManagers()[0]->getPrincipalOffice()->getName();
        if ($request->request->get("excel")) {
            // dd(1);
            $suitableInitiativesprincipal = $em->getRepository(SuitableInitiative::class)->findBy(['principalOffice' => $principalOffice]);
            $spreadsheet = new Spreadsheet();

            foreach (range('A', 'E') as $columnID) {
                $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            }
            $count=1;
            foreach ($suitableInitiativesprincipal as $result) {
                $count=$count+1;

            }
            // dd($count);
            $A1="A1";
            $Af='A'.'3';
            // dd($Af);
            $sheet = $spreadsheet->getActiveSheet();

            $spreadsheet->getActiveSheet()->getStyle('A1:A'.$count.'')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00000000');


            $sheet->setCellValue('A1', 'Initiative Code');
            $sheet->setCellValue('B1', 'Initiative Name');
            $sheet->setCellValue('C1', 'Q1');
            $sheet->setCellValue('D1', 'Q2');
            $sheet->setCellValue('E1', 'Q3');
            $sheet->setCellValue('F1', 'Q4');
            // $totalResult = $initiativestotal;
            // dd($totalResult);
            $x = 2;
            $soh = 0;
            foreach ($suitableInitiativesprincipal as $result) {
              if (!count($result->getInitiative()->getSocialAtrribute()) > 0) {
                $sheet->setCellValue('A' . $x, $result->getInitiative()->getId());
                $sheet->setCellValue('B' . $x, $result->getInitiative()->getName());
                $sheet->setCellValue('C' . $x, "");
                $sheet->setCellValue('D' . $x, "");
                $sheet->setCellValue('E' . $x, "");
                $sheet->setCellValue('F' . $x, "");


                $x++;
                        }
            }
            $writer = new Xlsx($spreadsheet);
            $fileName = $principalOfficeName . "Suitable Initiative" . '.xlsx';
            $temp_file = tempnam(sys_get_temp_dir(), $fileName);
            $writer->save($temp_file);
            return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
        }
        $principalOffice = $this->getUser()->getPrincipalManagers()[0]->getPrincipalOffice()->getId();
        $filterForm = $this->createFormBuilder()
            ->add("planyear", EntityType::class, [
                'class' => PlanningYear::class,
                'multiple' => true,
                'placeholder' => 'Choose an planning year',
                'required' => false,

            ])
            ->add("initiative", EntityType::class, [
                'class' => Initiative::class,
                'multiple' => true,
                'placeholder' => 'Choose an planning year',
                'required' => false,

            ])
            ->add('principaloffice', EntityType::class, [
                'class' => PrincipalOffice::class,
                'multiple' => true,
                'required' => false,

                'placeholder' => 'Choose an principal office',
            ])
            ->getForm();
        $filterForm->handleRequest($request);
        if ($filterForm->isSubmitted() && $filterForm->isValid()) {

            $suitableInitiatives = $suitableInitiativeRepository->search($filterForm->getData());
        } else
            $suitableInitiatives = $suitableInitiativeRepository->findBy(["principalOffice" => $principalOffice]);
        $principalOffice = $this->getUser()->getPrincipalManagers()[0]->getPrincipalOffice()->getId();
        $suitableInitiatives = $suitableInitiativeRepository->findBy(["principalOffice" => $principalOffice]);
        return $this->render('operational_task/report.html.twig', [
            'suitable_initiatives' => $suitableInitiatives,
            'filterform' => $filterForm->createView()
        ]);
    }

    /**
     * @Route("/accomplisment/{id}", name="acomplishment_task_detail")
     */
    public function accomplishment(Request $request, SuitableOperational $suitableOperational, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $socialAttr = 0;
        $user = $this->getUser();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user, 'status' => 1]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
        }
        $social = 0;
        // dd($suitableOperational->getSuitableInitiative()->getInitiative()->getSocialAtrribute());
        foreach ($suitableOperational->getSuitableInitiative()->getInitiative()->getSocialAtrribute() as $va) {
            if ($va->getName()) {
                $social = 1;
            }
        }
        $initiativeName = $suitableOperational->getSuitableInitiative()->getInitiative()->getName();
        $initiativeId = $suitableOperational->getId();
        $performerTasks = $em->getRepository(PerformerTask::class)->findInitiativeBySocial($suitableOperational, $user);
        $taskAcomolishs = $taskAccomplishmentRepository->findDetailAccomplishSocial($suitableOperational, $user);
        $time = new DateTime('now');
        $endDate = 0;
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        foreach ($quarters as $quarter) {
            if ($time >= $quarter->getStartDate() && $time < $quarter->getEndDate()) {
                $endDate = $quarter->getEndDate();
            }
        }
        $diff = $endDate->diff($time);
        if ($diff->m == 0) {
            $remainingdays = $diff->d;
        } else {
            $remainingdays = $diff->m * 30 + $diff->d;
        }
        // dd($performerTasksmale);
        return $this->render('operational_task/accomplishmentDetail.html.twig', [
            'taskAcomolishs' => $taskAcomolishs,
            'initiativeName' => $initiativeName,
            'initiativeId' => $initiativeId,
            'performerTasks' => $performerTasks,
            'social' => $social,
            'remainingdays' => $remainingdays,

        ]);
    }

    /**
     * @Route("/send_principal", name="send_to_principal")
     */
    public function sendToPrincipal(Request $request, OperationalSuitableInitiativeRepository $operationalSuitableInitiativeRepository, PlanningQuarterRepository $planningQuarterRepository, OperationalManagerRepository $operationalManagerRepository, PlanningAccomplishmentRepository $planningAccomplishmentRepository, PerformerTaskRepository $performerTaskRepository)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->request->get("planOffice")) {
            $planAcomplismentId = $request->request->get("planId");
            //   $planAcomplismentIdSocial=$request->request->get("planIdSocial");
            $social = $request->request->get("social");
            $acompAverages = $request->request->get("acompAvareage");

            $quarter = $request->request->get("quarter");
            // dd($acompAverages,$planAcomplismentId);

            if ($social[0]) {
                $operationalSuitables = $operationalSuitableInitiativeRepository->findBy(['PlanningAcomplishment' => $planAcomplismentId[0]]);
                foreach ($operationalSuitables as $value) {
                    $value->setStatus(2);
                }
                $operationalSuitables = $operationalSuitableInitiativeRepository->findBy(['PlanningAcomplishment' => $planAcomplismentId[1]]);
                foreach ($operationalSuitables as $value) {
                    $value->setStatus(2);
                }
                foreach ($acompAverages as $key => $value) {

                    $planAcomplishments = $planningAccomplishmentRepository->find($planAcomplismentId[$key]);
                    $planAcomplishments->setAccompValue($value);
                }

                $em->flush();
            } else {
                $operationalSuitables = $operationalSuitableInitiativeRepository->findBy(['PlanningAcomplishment' => $planAcomplismentId[0]]);
                foreach ($operationalSuitables as $value) {
                    $value->setStatus(2);
                }


                $planAcomplishments = $planningAccomplishmentRepository->find($planAcomplismentId[0]);
                $planAcomplishments->setAccompValue($acompAverages[0]);
                $em->flush();
            }
            $this->addFlash('success', 'Successfully Send To Plan Office !');

            return $this->redirectToRoute('principal_office_report');
        }
        $user = $this->getUser();
        $operation = $operationalManagerRepository->findOneBy(['manager' => $user]);
        $opOffice = $operation->getOperationalOffice();
        $principal = $opOffice->getPrincipalOffice();
        $accomp = $request->request->get('accomp');
        $suitiniId = $request->request->get('suitableinitiative');
        $quarterId = $request->request->get('quarterId');
        $quarter = $planningQuarterRepository->find($quarterId);
        $socialAttribute = $em->getRepository(InitiativeAttribute::class)->findAll();
        $performerTasks1 = $performerTaskRepository->findsendToprincipalSocial($user, $suitiniId);
        foreach ($performerTasks1 as $value) {
            $value->setStatus(0);
        }

        $plannings = $em->getRepository(OperationalPlanningAccomplishment::class)->findplanAccwithoutSocial($suitiniId, $opOffice, $quarter);
        // dd($plannings);
        //  $plannings1=$planningAccomplishmentRepository->findplanAcc($suitiniId,$socialAttribute2,$principal,$quarter); 
        foreach ($plannings as $key => $value) {
            # code...

            $operationalSuitableInitiative = new OperationalSuitableInitiative();
            $operationalSuitableInitiative->setOperationalPlanning($value);
            $operationalSuitableInitiative->setOperationalOffice($opOffice);
            $operationalSuitableInitiative->setAccomplishedValue($accomp[$key]);
            $operationalSuitableInitiative->setQuarter($quarter);
            $operationalSuitableInitiative->setSocial($socialAttribute[$key]);

            $operationalSuitableInitiative->setStatus(1);
            $em->persist($operationalSuitableInitiative);
        }
        $em->flush();


        $this->addFlash('success', 'Successfully Send To Principal Office !');
        return $this->redirectToRoute('suitable_initiative_list');
    }
    /**
     * @Route("/suitableInitiative_principal_list", name="suitable_initiative_principal_list")
     */
    public function suitableInitiativeprincipal(Request $request,   SuitableInitiativeRepository $suitableInitiativeRepository, PrincipalManagerRepository $principalManagerRepository): Response
    {
        $user = $this->getUser();
        $social = 0;
        $operation = $principalManagerRepository->findOneBy(['principal' => $user]);
        $principlaOffice =  $operation->getPrincipalOffice()->getId();
        $suitableInitiatives = $suitableInitiativeRepository->findBy(["principalOffice" => $principlaOffice]);
        return $this->render('operational_task/suitable_principal.html.twig', [
            'suitableInitiatives' => $suitableInitiatives,
        ]);
    }

    /**
     * @Route("/intiative_accomplishment/{id}", name="initiative_accomplishment_list")
     */
    public function acomplishmentList(Request $request, SuitableInitiative $suitableInitiative,  OperationalSuitableInitiativeRepository $operationalSuitableInitiativeRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $socialcount = 0;
        $socialAttr = 0;
        $principalOffice = $suitableInitiative->getPrincipalOffice()->getId();

        $socials = $suitableInitiative->getInitiative()->getSocialAtrribute();
        $initiativeName = $suitableInitiative->getInitiative()->getName();
        $time = new DateTime('now');
        $endDate = 0;
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        foreach ($quarters as $quarter) {
            if ($time >= $quarter->getStartDate() && $time < $quarter->getEndDate()) {
                $endDate = $quarter->getEndDate();
            }
        }
        $diff = $endDate->diff($time);
        if ($diff->m == 0) {
            $remainingdays = $diff->d;
        } else {
            $remainingdays = $diff->m * 30 + $diff->d;
        }
        if ($socials) {

            foreach ($socials as $so) {
                if ($so->getCode() == 1) {
                    $socialAttr = 1;
                    $male = $so->getId();
                }
                if ($so->getCode() == 2) {
                    $female = $so->getId();
                }
            }
        }
        if ($socialAttr == 1) {
            // dd($suitableInitiative->getId());
            $operatioanlSuitables = $operationalSuitableInitiativeRepository->findplanSocial($principalOffice, $suitableInitiative->getId(), $male);
            $operatioanlSuitablessocails = $operationalSuitableInitiativeRepository->findplanSocial($principalOffice, $suitableInitiative->getId(), $female);
            $planningAcc = $em->getRepository(PlanningAccomplishment::class)->findBy(['suitableInitiative' => $suitableInitiative->getId()]);
            // dd($planningAcc);
            return $this->render('operational_task/initiativeAccomplishment.html.twig', [
                'operatioanlSuitables' => $operatioanlSuitables,
                'operatioanlSuitablessocails' => $operatioanlSuitablessocails,
                'initiativeName' => $initiativeName,
                'planningAcc' => $planningAcc,
                'remainingdays' => $remainingdays,
                'social' => 1,

            ]);
        } else {
            $operatioanlSuitables = $operationalSuitableInitiativeRepository->findplan($principalOffice, $suitableInitiative->getId());
            $planningAcc = $em->getRepository(PlanningAccomplishment::class)->findBy(['suitableInitiative' => $suitableInitiative->getId()]);
            // dd($planningAcc);
            // dd($operatioanlSuitables);
            return $this->render('operational_task/initiativeAccomplishment.html.twig', [
                'operatioanlSuitables' => $operatioanlSuitables,
                'initiativeName' => $initiativeName,
                'remainingdays' => $remainingdays,
                'planningAcc' => $planningAcc,
                'social' => 0,
            ]);
        }
    }
    /**
     * @Route("/userFetch", name="user_fetch")
     */
    public function OperationalFetch(Request $request, PerformerRepository $performerRepository, UserInfoRepository $userInfoRepository)
    {
        $office = $request->request->get('userprincipal');
        $units = $performerRepository->findAllsUser($request->request->get('userprincipal'));
        return new JsonResponse($units);
    }
    /**
     * @Route("/taskFetch", name="task_fetch")
     */
    public function taskFetch(Request $request, PerformerTaskRepository $performerTaskRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $userId = $request->request->get("user");
        $users = $em->getRepository(User::class)->find($userId);
        $user = $users->getId();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user, 'status' => 1]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy()->getId();
            $user = $delegatedBy;
        }
        $units = $performerTaskRepository->filterDeliverBy($request->request->get('task'), $user, $request->request->get('quartertask'));
        // dd($units);

        return new JsonResponse($units);
    }
    /**
     * @Route("/new", name="operational_task_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $operationalTask = new OperationalTask();
        $form = $this->createForm(OperationalTaskType::class, $operationalTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($operationalTask);
            $entityManager->flush();
            return $this->redirectToRoute('operational_task_index');
        }
        return $this->render('operational_task/new.html.twig', [
            'operational_task' => $operationalTask,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/show", name="operational_task_show")
     */
    public function show(Request $request, TaskAssignRepository $taskAssignRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
            // dd($delegatedUser->getDelegatedtaskUserUser());
        }
        $taskAssigns = $taskAssignRepository->findTaskUsersList($user);
        return $this->render('operational_task/show.html.twig', [
            'taskAssigns' => $taskAssigns,
        ]);
    }
    /**
     * @Route("/show_detail", name="operational_task_show_detail")
     */
    public function showDetail(Request $request, TaskAccomplishmentRepository $taskAccomplishmentRepository, TaskAssignRepository $taskAssignRepository)
    {
        $em = $this->getDoctrine()->getManager();


        if ($request->request->get('reportValue')) {
            $percent = 0;
            $reportValue = $request->request->get('reportValue');
            $reportValueSocial = $request->request->get('reportValueSocial');
            $quality = $request->request->get('quality');
            $ids = $request->request->get('taskAccomplishmentId');
            //   foreach ($ids as $key => $value) {
            $evaluation = new Evaluation();
            $taskAccomplishment = $taskAccomplishmentRepository->find($ids);
            $percent = (($reportValue * 100) / $taskAccomplishment->getExpectedValue());
            $evaluateUser = $taskAccomplishment->getTaskAssign()->getAssignedTo();
            $taskAccomplishment->setAccomplishmentValue($reportValue);
            if ($reportValueSocial) {
                $taskAccomplishment->setAccomplishmentValueSocial($reportValueSocial);
            }
            $evaluation->setEvaluateUser($evaluateUser);
            $evaluation->setTaskAccomplishment($taskAccomplishment);
            $evaluation->setQuantity($percent);
            $evaluation->setQuality($quality);
            $taskUser = $taskAssignRepository->findOneBy(['id' => $taskAccomplishment->getTaskAssign()->getId()]);
            $taskUser->setType(3);
            $em->persist($evaluation);
            //   }
            $em->flush();
            $this->addFlash('success', 'Successfully Operational Manager set Acomplisment value  !');
            return $this->redirectToRoute('operational_task_show');
        }
        $taskAssign = $request->request->get('taskAssign');
        //    dd($taskUser);
        $taskAccomplishments = $taskAccomplishmentRepository->findBy(['taskAssign' => $taskAssign]);
        $taskAssigns = $taskAssignRepository->findBy(['id' => $taskAssign]);
        foreach ($taskAssigns as $value) {
            $endDate = $value->getEndDate();
            $endDates = explode('/', $endDate);
            $date = new DateTime();
        }
        $task = $taskAssignRepository->find($taskAssign);
        if ($task->getType() < 2) {
            $task->setType(2);
            $em->flush();
        }
        $social = 0;

        foreach ($taskAccomplishments[0]->getTaskAssign()->getPerformerTask()->getOperationalPlanningAcc()->getOperationalSuitable()->getSuitableInitiative()->getInitiative()->getSocialAtrribute() as $va) {
            if ($va->getName()) {
                $social = 1;
            }
        }

        return $this->render('operational_task/showDetail.html.twig', [
            'taskAccomplishments' => $taskAccomplishments,
            'taskAssigns' => $taskAssigns,
            'social' => $social
        ]);
    }

    /**
     * @Route("/approve", name="task_operarional_approve")
     */
    public function approve(Request $request, PlanRepository $planRepository, TaskUserRepository $taskUserRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $em = $this->getDoctrine()->getManager();

        $taskId = $request->request->get('taskUserId');
        $taskUser = $taskUserRepository->find($taskId);
        $planId = $taskUser->getTaskAssign()->getPerformerTask()->getPlan()->getId();
        $plans = $planRepository->find($planId);
        $plans->setStatus(3);

        $em->flush();
        $this->addFlash('success', 'Approved Successfully !');
        $taskUser = $request->request->get('taskUser');
        //  dd($taskUser);
        $taskUserId = 0;
        $taskUsers = $taskUserRepository->findPerformerTask($taskUser);
        foreach ($taskUsers as  $value) {
            $taskUserId = $value->getId();
        }
        $taskAccomplishments = $taskAccomplishmentRepository->findBy(['taskUser' => $taskUserId]);


        return $this->render('operational_task/show.html.twig', [
            'taskAccomplishments' => $taskAccomplishments,
            'taskUsers' => $taskUsers,
        ]);
        // return new JsonResponse($taskUser);

    }
    /**
     * @Route("/{id}/edit", name="operational_task_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OperationalTask $operationalTask): Response
    {
        $form = $this->createForm(OperationalTaskType::class, $operationalTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operational_task_index');
        }

        return $this->render('operational_task/edit.html.twig', [
            'operational_task' => $operationalTask,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="operational_task_delete", methods={"DELETE"})
     */
    public function delete(Request $request, OperationalTask $operationalTask): Response
    {
        if ($this->isCsrfTokenValid('delete' . $operationalTask->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($operationalTask);
            $entityManager->flush();
        }

        return $this->redirectToRoute('operational_task_index');
    }
}
