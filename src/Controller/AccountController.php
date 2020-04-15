<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\ChangePasswordType;
use App\Form\ChangeUsernameType;
use App\Service\Encoder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends AbstractController
{  private $entityManager;
    /**
     * @Route("/account", name="security_account")
     */
    public function account(UsersRepository $userBD)
    {
        $userId = $this->getUser()->getId();
        $user = $userBD->find($userId);
        return $this->render('security/account.html.twig',[
            'user' => $user
        ]);
    }
    
    /**
     * @Route("/account/editusername", name="security_account_username")
     */
    public function updateUsername(Request $request,EntityManagerInterface $manager)
    {
        $user=$this->getUser();
        $form=$this->createForm(ChangeUsernameType::class,$user);
        $form->handleRequest($request);
        //$newUsername= $form->get('username')->getData();
        if($form->isSubmitted()&&$form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $newUsername= $form->get('username')->getData();
            $req=$entityManager->getRepository(Users::class)->findBy(['username'=>$newUsername]);
            if (empty($req)){
                $user->setUsername($newUsername);
                $entityManager->persist($user);
                $entityManager->flush();
            }
            else{
                throw $this->createNotFoundException(
                    'Pseudo déja utilisé '
                );
            }
        }
        return $this->render('security/editUsername.html.twig',['formUsername' => $form->createView()]);
    }
     /**
     * @Route("/account/editpass", name="security_account_pass")
     */
    public function updatePassword(Request $request,Encoder $encoder)
    {
        $user=$this->getUser();
        $form=$this->createForm(ChangePasswordType::class,$user);
        $form->handleRequest($request);
        $newPass= $user->getPassword();
        
        if($form->isSubmitted()&&$form->isValid()){
                $user->setPassword($newPass);
                $encoder->encoder($user);
                return $this->redirectToRoute('security_account');
        }
        return $this->render('security/editPassword.html.twig',['formPassword'=>$form->createView()]);
    }

}