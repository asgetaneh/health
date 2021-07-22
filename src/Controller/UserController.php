<?php

namespace App\Controller;

use App\Entity\UserGroup;
use App\Security\LoginFormAuthenticator;
use App\Repository\UserRepository;
use App\Repository\UserGroupRepository;
use App\Repository\PermissionRepository;
use App\Repository\UserInfoRepository;
use Knp\Component\Pager\PaginatorInterface;
use Proxies\__CG__\App\Entity\UserInfo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(UserGroupRepository $userGroupRepository,Request $request,PaginatorInterface $paginator): Response
    {
       $this->denyAccessUnlessGranted("vw_usr_lst");
                    $user_groups= $userGroupRepository->findAll();
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
    public function userList( Request $request, PaginatorInterface $paginator, UserInfoRepository $userInfoRepository): Response
    {
        $this->denyAccessUnlessGranted("vw_usr_lst");
        if ($request->request->get("name")) {
      $users = $userInfoRepository->filter($request->request->get("name"));
    //   dd($users);
        }
        else{
        $users = $userInfoRepository->findAll(); }
        $data = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('user/userlist.html.twig', [
            'users' => $data,
            'count'=>$users,
        ]);
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
