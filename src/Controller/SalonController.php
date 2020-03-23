<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Entity\Game;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\GameRepository;
use App\Repository\UsersRepository;


class SalonController extends AbstractController
{


    /**
     * @Route("/Acceuil/salon",name="salon")
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
         }else {

            $user2 = $userBD->find($idP2);

            $nameP2 = $user2->getUsername();

            dump($nameP2);
         }

        $user1 = $userBD->find($idP1);

        $name = $user1->getUsername();



         dump($name);
         dump($nameP2);



        return $this->render('quizz/salon.html.twig',[
            'player' => $name , 'player2' => $nameP2 ,
            'login' => $logUsername
        ]);


        


    }

    
    /**
     * @Route("/Acceuil/play",name="play")
     */
    public function play()
    {
        



    }

    

}