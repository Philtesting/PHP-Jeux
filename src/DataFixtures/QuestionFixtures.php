<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Quizz;

class QuestionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        for ($i=32;$i<=42;$i++){
            $valeur = random_int(100, 999);
            $reponse = $valeur * $i ;
            $question = $valeur * $i * $i ;
            $quizz=new Quizz();
            $quizz->setQuestion("$valeur multipliée par $i ça fait ?")
                  ->setBonneReponse("$reponse")
                  ->setReponse1("$question")
                  ->setReponse2($question*10)
                  ->setReponse3($valeur)
                  ->setNiveau(3)
                  ;

            $manager->persist($quizz);
        }
        $manager->flush();
    }
}
