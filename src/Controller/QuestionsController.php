<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class QuestionsController  extends AbstractController
{
    /**
     * @Route("/questions",name="questions")
     */
    public function home()
    {
        return $this->render('questions.html.twig');
    }

}