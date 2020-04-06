<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameCreationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\GameRepository;
use App\Repository\UsersRepository;


/**
 * @Route("/room", name="room.")
 */

class RoomController extends AbstractController
{
    /**
     * @Route("/quizz/index", name="quizz.index")
     */
    public function index(GameRepository $gameBD){
        $games = $gameBD->findBy(
            array(),
            array('id' => 'DESC')
        );
        return $this->render('quizz/allRooms.html.twig', [
            'games' => $games,
        ]);
    }

    /**
     * @Route("/quizz/create",name="quizz.create")
     */
    public function roomCreate(Request $request){

        $game = new Game();
        $form = $this->createForm(GameCreationType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $user = $this->getUser();
            $game->setPlayerOne($user);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();
            
            return $this->redirect($this->generateUrl('join'));
        }

        return $this->render('quizz/createGame.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/quizz/salon",name="quizz.salon")
     */
    public function dataNomSalon(UsersRepository $userBD , GameRepository $gameBD)
    {
        

        $userId = $this->getUser()->getId();
        $user = $userBD->find($userId);
        $logUsername = $user->getUsername();
        
        $P2 = $gameBD->findOneBy(
            array(), 
            array('id' => 'DESC'),
            
            
        );
        
        $idP1 = $P2->getPlayerOne();
        $idP2 = $P2->getPlayerTwo();

         if ($idP2 == NULL ) {
            $nameP2 = 'Il manque un joueur' ;
         }
         else {
            $user2 = $userBD->find($idP2);
            $nameP2 = $user2->getUsername();
         }

        $user1 = $userBD->find($idP1);
        $name = $user1->getUsername();

        return $this->render('quizz/room.html.twig',[
            'player' => $name , 'player2' => $nameP2 ,
            'login' => $logUsername
        ]);
    }

}