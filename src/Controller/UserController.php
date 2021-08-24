<?php

namespace App\Controller;

use App\Entity\UserGroup;
use App\Security\LoginFormAuthenticator;
use App\Repository\UserRepository;
use App\Repository\UserGroupRepository;
use App\Repository\PermissionRepository;
use App\Repository\UserInfoRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use Proxies\__CG__\App\Entity\UserInfo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(UserGroupRepository $userGroupRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted("vw_usr_lst");
        $user_groups = $userGroupRepository->findAll();
        $data = $paginator->paginate(
            $user_groups,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('user_group/index.html.twig', [
            'user_groups' => $data,
        ]);
    }

    /**
     * @Route("/user/list", name="user_list")
     */
    public function userList(Request $request, PaginatorInterface $paginator, UserInfoRepository $userInfoRepository): Response
    {
        $this->denyAccessUnlessGranted("vw_usr_lst");

        $form = $this->createFormBuilder()
            ->setMethod('Get')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'All' => null,
                    'Choose Office' => 1,
                    'Not Choose Office' => 0

                ]
            ])->getForm();;
        $session = new Session();
        $session->remove('filter');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $session->set('filter', $form->getData());

            $users = $userInfoRepository->findStatus($form->getData());
            // dd($users);
        } else if ($request->request->get("name")) {
            $users = $userInfoRepository->filter($request->request->get("name"));
            //   dd($users);
        } else {
            $users = $userInfoRepository->findAll();
        }
        // dd($users);
        $data = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('user/userlist.html.twig', [
            'users' => $data,
            'count' => $users=$userInfoRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/user_printes", name="print_user", methods={"GET","POST"})
     */

    public function print(Request $request, PaginatorInterface $paginator, UserInfoRepository $userInfoRepository)
    {
        $session = new Session();
        // $em = $this->getDoctrine()->getManager();
        $entityManager = $this->getDoctrine()->getManager();
        if ($session->get('filter')) {

            $users  = $userInfoRepository->findStatus($session->get('filter'))->getResult();
            // dd($users);
        } else {
            $users = $userInfoRepository->findAll();
        }
        $count = 0;
        foreach ($users as $user) {
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
        $body  = '<center><h3 >JU Mis User   </h3></center>Total : ' . $count . ' <br/>';
        $table = '    
                    <table border="1" >
                    <thead>
                        <tr >
                            <th width="10">#</th>
                            <th width="45">Full Name</th>
                         <th width="15">Phone NUmber</th>
                            <th width="15">Email</th>
                                    <th width="15">Office</th>

                           

                            
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($users as $user) {

            $c += 1;
            $table .= '<tr><td>' . $c . '</td><td> ' . $user->getFullName() . '</td><td>' . $user->getUser()->getMobile() . '</td>
            <td> ' . $user->getEmail() . '</td>';
            if ($user->getUser()->getStatus() == 1) {
                $table .= '	<td>Choose
                 </td>';
            } else {
                $table .= '	<td>Not Choose
                 </td>';
            }
            '<td> ' . $user->getEmail() . '</td>
            
           

        
             </tr>';
        }

        $table .= ' </tbody></table>';
        $end = '</body></html>';
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
     * @Route("/{id}/users", name="user_group_users", methods={"POST"})
     */
    public function user(UserGroup $userGroup, Request $request, UserRepository $userRepository)
    {
        $this->denyAccessUnlessGranted('vw_usr_lst');

        if ($request->request->get('usergroupuser')) {
            $users = $userRepository->findAll();
            foreach ($users as $user) {
                $userGroup->removeUser($user);
            }
            $users = $userRepository->findBy(['id' => $request->request->get('user')]);
            foreach ($users as $user) {
                $userGroup->addUser($user);
            }
            $userGroup->setUpdatedAt(new \DateTime());
            $userGroup->setUpdatedBy($this->getUser());
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->render('user/user.html.twig', [
            'user_group' => $userGroup,
            'users' => $userRepository->findForUserGroup($userGroup->getUsers()),

        ]);
    }
    /**
     * @Route("/{id}/permission", name="user_group_permission", methods={"POST"})
     */
    public function permission(UserGroup $userGroup, Request $request, PermissionRepository $permissionRepository)
    {
        $this->denyAccessUnlessGranted("vw_usr_lst");
        if ($request->request->get('usergrouppermission')) {
            $permissions = $permissionRepository->findAll();
            foreach ($permissions as $permission) {
                $userGroup->removePermission($permission);
            }
            $permissions = $permissionRepository->findBy(['id' => $request->request->get('permission')]);
            foreach ($permissions as $permission) {
                $userGroup->addPermission($permission);
            }
            $userGroup->setUpdatedAt(new \DateTime());
            $userGroup->setUpdatedBy($this->getUser());
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->render('user/permission.html.twig', [
            'user_group' => $userGroup,
            'permissions' => $permissionRepository->findForUserGroup($userGroup->getPermission()),

        ]);
    }
    //     /**
    //      * @Route("/userFetch", name="user_group_permission")
    //      */
    //      public function setting(LoginFormAuthenticator $usernamecc)
    //      {
    //          $usernamed="abebe";
    // $usernamecc->getUserlist($usernamed);
    //          $srs = $this->getDoctrine()->getConnection('srs');
    //          $sis = $this->getDoctrine()->getConnection();


    //      }
}
