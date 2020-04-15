<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameCreationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/room", name="room.")
 */

class RoomController extends AbstractController
{
    /**
     * @Route("/quizz/index", name="quizz.index")
     */
    public function index(GameRepository $gameBD){
        $games = $gameBD->playerNull();
        dump($games);
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
            $game->setPlayerTwo(null);
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();
            
            return $this->redirect($this->generateUrl('room.quizz.salon',
            [
                'id' => $game->getId()
            ]));
        }

        return $this->render('quizz/createGame.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/quizz/salon/{id}/{ready?}",name="quizz.salon")
     */
    public function dataNomSalon($id,$ready, Request $request, GameRepository $gameBD)
    {
        $user = $this->getUser();
        $game = $gameBD->find($id);
        $player1 = $game->getPlayerOne();
        $player2 = $game->getPlayerTwo();

        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {  
            $jsonData = array();
            if(isset($player2)){
                $player2Name = $player2->getUsername(); 
            }
            else{
                $player2Name = $player2;
            }

            if( isset($ready) ){
                $em = $this->getDoctrine()->getManager();
                if($player1 == $user){
                    $game->setStatusP1(0);
                }
                else{
                    $game->setStatusP2(0);
                }
                $em->flush();
            }
            $statusP1 = $game->getStatusP1();
            $statusP2 = $game->getStatusP2();

            $temp = array(
                'P1' => $game->getPlayerOne()->getUsername(),  
                'P2' => $player2Name,
                'statusP1' => $statusP1 ,  
                'statusP2' => $statusP2   
                );
            $jsonData[0]=$temp;
            return new JsonResponse($jsonData); 
        }
        else{
            
            if($player1 != $user && $player2 != $user){
                return $this->redirect($this->generateUrl('home')); 
            } 
    
            return $this->render('quizz/room.html.twig', [
                'game' => $game,
                'user' => $user,
                'id' => $id
            ]);
        }
    }


    /**
     * @Route("/quizz/join/{id}",name="quizz.join")
     */
    public function quizzJoinSalon($id ,GameRepository $gameBD)
    {
        $user = $this->getUser();
        $gameCurr = $gameBD->find($id);

        if($gameCurr->getPlayerOne() == $user){
            $this->addFlash('success', 'Vous ne pouvez pas joindre que vous avez crée');
            return $this->redirectToRoute('room.quizz.index');
        }

        $gameCurr -> setPlayerTwo($user);
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirect($this->generateUrl('room.quizz.salon',
            [
                'id' => $gameCurr->getId()
            ]));
    }

}