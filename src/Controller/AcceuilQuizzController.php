<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Entity\Game;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\GameRepository;

    /**
     * @Route("/game",name="")
     */
class AcceuilQuizzController extends AbstractController
{
    /**
     * @Route("/Acceuil",name="acceuil")
     */
    public function account()
    {
        $user = $this->getUser();
        return $this->render('quizz/acceuil.html.twig');
    }



    /**
     * @Route("/Acceuil/creer",name="creation")
     */

    public function createGame()
    {   

        
        $user = $this->getUser();
        $level = 1 ;
        $game = new Game();
        $game->setPlayerOne($user);
        $game->setNameGame(uniqid());
        $game->setLevel($level);

        dump($game);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($game);
        $em->flush();

        return $this->redirect($this->generateUrl('salon'));

    }


    /**
     * @Route("/Acceuil/join",name="join")
     */

    public function joinGame(GameRepository $gameBD)
    {

        $em = $this->getDoctrine()->getManager();

        $userId = $this->getUser()->getId();

        $P2 = $gameBD->findOneBy(
            array(), 
            array('id' => 'DESC'),
            
            
        );

        
        $user = $this->getUser();
        $P2->setPlayerTwo($user);
        $em->flush();

        return $this->redirect($this->generateUrl('salon'));

    }
}