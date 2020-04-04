<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

 /**
 * @Route("/classement",name="class.")
 */
class ClassementController  extends AbstractController
{
    /**
     * @Route("/index",name="index")
     */
    public function home(UsersRepository $userBD)
    {
        $scoreF = $userBD->findBy(
            array(),
            array('scoreFacil' => 'DESC')
        );
        $scoreM = $userBD->findBy(
            array(),
            array('scoreMoyen' => 'DESC')
        );
        $scoreD = $userBD->findBy(
            array(),
            array('scoreDifficil' => 'DESC')
        );


        return $this->render('classement/index.html.twig',[
            'scoreF' => $scoreF,
            'scoreM' => $scoreM,
            'scoreD' => $scoreD
        ]);
    }


}