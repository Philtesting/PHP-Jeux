<?php

namespace App\Controller;

use App\Entity\Quizz;
use App\Repository\QuizzRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/game",name="game.")
 */
class QuizzController extends AbstractController
{
    /**
     * @Route("/quizz/{difficulter}",name="quizz")
     */
    public function sendQuestionsToGame($difficulter ,QuizzRepository $quizzDb)
    {
        $quizz = $quizzDb->findBy(['niveau' => $difficulter]);

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
            'quizz' => $arrayCollection
        ]);
    }
    /**
     * @Route("/highscore",name="highscore")
     */
    public function sendHighScore(Request $request){
        $getCookies = Request::createFromGlobals();
        $score = $getCookies->cookies->get('highscore');
        dump($request);
        return $this->render('base.html.twig');
    }
}