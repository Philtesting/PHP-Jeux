<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuizzController extends AbstractController
{
    /**
     * @Route("/quizz",name="security_account")
     */
    public function account()
    {
        $user = $this->getUser();
        return $this->render('quizz/quizz.html.twig');
    }
}