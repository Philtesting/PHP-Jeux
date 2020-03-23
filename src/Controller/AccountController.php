<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UsersRepository;

class AccountController extends AbstractController
{
    /**
     * @Route("/account",name="security_account")
     */
    public function account(UsersRepository $userBD)
    {
        $userId = $this->getUser()->getId();
        $user = $userBD->find($userId);
        return $this->render('security/account.html.twig',[
            'user' => $user
        ]);
    }
}