<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizzS extends AbstractController
{
    /**
     * @Route("/quizz")
     */
    public function quizz()
    {
        return $this->render('Quizz/singleplayer.html.twig');
    }
}