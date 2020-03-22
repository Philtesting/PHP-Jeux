<?php

namespace App\Controller;

use App\Entity\Quizz;
use App\Entity\Users;
use App\Repository\QuizzRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/game",name="game.")
 */
class QuizzController extends AbstractController
{
    /**
     * @Route("/quizz/{difficulter}",name="quizz")
     */
    public function sendQuestionsToGame($difficulter ,QuizzRepository $quizzBD)
    {
        $quizz = $quizzBD->findBy(['niveau' => $difficulter]);

        $arrayCollection = array();

        foreach($quizz as $item) {
             $arrayCollection[] = array(
                 'question' => $item->getQuestion(),
                 // ... Same for each property you want
                 'bonneReponse'=> $item->getBonneReponse(),
                 'reponse1' => $item->getReponse1(),
                 'reponse2' => $item->getReponse2(),
                 'reponse3' => $item->getReponse3(),
             );
        }
                
        dump($arrayCollection);
        return $this->render('quizz/quizz.html.twig',[
            'quizz' => $arrayCollection,
            'difficulter' => $difficulter
        ]);
    }
    /**
     * @Route("/highscore",name="highscore")
     */
    public function sendHighScore(UsersRepository $userBD){
        $getCookies = Request::createFromGlobals();
        
        $score = $getCookies->cookies->get('highscore');
        $difficulter = $getCookies->cookies->get('difficulter');

        $entityManager = $this->getDoctrine()->getManager();

        $userId = $this->getUser()->getId();
        $user = $userBD->find($userId);

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
        $entityManager->flush();
        return $this->render('base.html.twig');
    }
}