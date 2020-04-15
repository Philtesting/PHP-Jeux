<?php

namespace App\Controller;

use App\Repository\GameRepository;
use App\Repository\QuizzRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/game",name="game.")
 */
class QuizzController extends AbstractController
{
    /**
     * @Route("/quizz/index/{id}",name="quizz")
     */
    public function startGame($id ,GameRepository $gameBD, QuizzRepository $quizzBD)
    {
        $game = $gameBD->find($id);
        $user = $this->getUser();

        if($game->getPlayerOne() != $user && $game->getPlayerTwo() != $user){
            return $this->redirect($this->generateUrl('home')); 
        }


        if($game->getPlayerOne() == $user){
            if($game->getStatusP1() == 1){
                return $this->redirect($this->generateUrl('game.quizz.results',[
                    'id' => $id
                ]));
            }
        }
        else{
            if($game->getStatusP2() == 1){
                return $this->redirect($this->generateUrl('game.quizz.results',[
                    'id' => $id
                ]));
            }
        }

        $difficulter = $game->getDifficulter();
        $quizz = $quizzBD->findBy(['difficulter' => $difficulter]);
        shuffle($quizz);

        $arrayCollection = array();
        $i = 1;
        foreach($quizz as $item) {
             $arrayCollection[] = array(
                 'question' => $item->getQuestion(),
                 'bonneReponse'=> $item->getBonneReponse(),
                 'reponse1' => $item->getReponse1(),
                 'reponse2' => $item->getReponse2(),
                 'reponse3' => $item->getReponse3(),
             );
            if($i == 10){
                break;
            }
            $i = $i + 1;
        }
        return $this->render('quizz/quizz.html.twig',[
            'quizz' => $arrayCollection,
            'difficulter' => $difficulter,
            'game' => $game
        ]);
    }

    /**
     * @Route("/send/score/{id}/{tab?}",name="quizz.send.score")
     */
    public function sendHighScore($id, $tab, GameRepository $gameBD){
        $user = $this->getUser();
        $game = $gameBD->find($id);

        $getCookies = Request::createFromGlobals();
        $score = $getCookies->cookies->get('highscore');
        $player1 = $game->getPlayerOne();
        $player2 = $game->getPlayerTwo();

        if($player1 != $user && $player2 != $user){
            return $this->redirect($this->generateUrl('home')); 
        }

        if($player1 == $user){
            if($game->getStatusP1() == 1){
                return $this->redirect($this->generateUrl('game.quizz.results',[
                    'id' => $id
                ]));
            }
        }
        else{
            if($game->getStatusP2() == 1){
                return $this->redirect($this->generateUrl('game.quizz.results',[
                    'id' => $id
                ]));
            }
        }
        
        if($tab == 'tab'){
            $em = $this->getDoctrine()->getManager();

            if($player1 == $user){
                $game->setScoreP1(0);
                $game->setStatusP1(1);
             }
            else{
                $game->setScoreP2(0);
                $game->setStatusP2(1);
            }
            $em->flush();
        }
        else{
            $difficulter = $game->getDifficulter();
    
            $entityManager = $this->getDoctrine()->getManager();
            if($difficulter == 0){
                $highscore =  $user->getScoreFacil();
                if($highscore < $score){
                    $user->setScoreFacil($score);
                }
            }
    
            else if($difficulter == 1){
                $highscore =  $user->getScoreMoyen();
                if($highscore < $score){
                    $user->setScoreMoyen($score);
                }
            }
    
            else if($difficulter == 2){
                $highscore =  $user->getScoreDifficil();
                if($highscore < $score){
                    $user->setScoreDifficil($score);
                }
            }
            $expCurr = $user->getExp();
            $exp = $expCurr + $score;

            if($exp>10000){
                $level = $user->getLevel();
                $user->setLevel($level+1);
                $user->setExp($exp+$score - 10000);
            }
            else{
                $user->setExp($exp+$score);
            }
            $entityManager->flush();
    
            $em = $this->getDoctrine()->getManager();
    
            if($player1 == $user){
                $game->setScoreP1($score);
                $game->setStatusP1(1);
            }
            else{
                $game->setScoreP2($score);
                $game->setStatusP1(1);
            }
            $em->flush();
        }


        return $this->redirect($this->generateUrl('game.quizz.results',[
            'id' => $id,
            'tab'=> $tab
        ]));
    }

    /**
     * @Route("/results/{id}/{tab?}",name="quizz.results")
     */
    public function resultsGame($id, $tab, GameRepository $gameBD)
    {
        $user = $this->getUser();
        $game = $gameBD->find($id);
        $player1 = $game->getPlayerOne();
        $player2 = $game->getPlayerTwo();

        if($player1 != $user && $player2 != $user){
            return $this->redirect($this->generateUrl('home')); 
        }

        if($tab == "tab"){
            $this->addFlash('warning', "Partie interrompu: Vous avez changer de onglet au milieu de la partie");
            
            if($user == $player1){
                $win = $player2;
                $scoreWin = $game->getScoreP2();
                $lose = $player1;
                $scoreLose = $game->getScoreP1();
            }
            else{
                $win = $player1;
                $scoreWin = $game->getScoreP1();
                $lose = $player2;
                $scoreLose =$game->getScoreP2();
            }
        }

        else{
    
            $scoreP1 = $game->getScoreP1();
            $scoreP2 = $game->getScoreP2();
    
            if(isset($scoreP1) && isset($scoreP1)){
                if($scoreP1 > $scoreP2){
                    $win = $player1;
                    $scoreWin = $scoreP1;
                    $lose = $player2;
                    $scoreLose = $scoreP2;
                }
                elseif($scoreP1 < $scoreP2){
                    $win = $player2;
                    $scoreWin = $scoreP2;
                    $lose = $player1;
                    $scoreLose = $scoreP1;
                }
                else{
                    $win = $player1;
                    $scoreWin = $scoreP1;
                    $lose = $player2;
                    $scoreLose = $scoreP2;
                }
            }
            elseif(!isset($scoreP2) && !isset($scoreP1)){
                $win = null;
                $scoreWin = null;
                $lose = null;
                $scoreLose = null;
            }
    
            elseif(!isset($scoreP1)){
                $win = $player2;
                $scoreWin = $scoreP2;
                $lose = null;
                $scoreLose = null;
            }
            else{
                $win = $player1;
                $scoreWin = $scoreP1;
                $lose = null;
                $scoreLose = null;
            }
        }


        return $this->render('quizz/results.html.twig',[
            'win' => $win,
            'scoreWin' => $scoreWin,
            'lose' => $lose,
            'scoreLose' => $scoreLose,
            'user' => $user
        ]);
    }
}