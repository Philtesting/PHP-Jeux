<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/game",name="game.")
 */
class QuizzController extends AbstractController
{
    /**
     * @Route("/quizz",name="quizz")
     */
    public function game()
    {
        $user = $this->getUser();
        return $this->render('quizz/quizz.html.twig');
    }
}