<?php

namespace App\Controller;

use App\Form\LoginType;
use App\Form\RegistrationType;
use App\Service\Encoder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{   private $entityManager;

    /**
     * @Route("/register",name="security_register")
     */
   public function registration(Request $request,Encoder $encoder){
        $user=new Users();
        $form=$this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
           $encoder->encoder($user);
           return $this->redirectToRoute('security_login');
        }
        return $this->render('security/registration.html.twig',['formRegister'=>$form->createView()]);
   }

    /**
     * @Route("/login",name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

   /**
    * @Route("/logout",name="security_logout")
    */
   public function logout(){
   }
}
