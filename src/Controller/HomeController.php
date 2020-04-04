<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController  extends AbstractController
{
    /**
     * @Route("/",name="home")
     */
    public function home()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/jeux",name="jeux")
     */
    public function listeJeux()
    {
        return $this->render('games/index.html.twig');
    }
}