<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use App\Form\ChangeUsernameType;
use App\Form\LoginType;
use App\Form\RegistrationType;
use App\Service\Encoder;
use App\Service\UpdatePassword;
use App\Service\UpdateUsername;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{  private $entityManager;
    /**
     * @Route("/account", name="security_account")
     */
    public function homeAccount()
    {
        return $this->render('security/account.html.twig');
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
        if($form->isSubmitted()&&$form->isValid()){
                $encoder->encoder($user);
                return $this->redirectToRoute('security_account');
        }
        return $this->render('security/editPassword.html.twig',['formPassword'=>$form->createView()]);
    }

}