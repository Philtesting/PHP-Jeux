<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Users;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1;$i<=10;$i++){
            $users=new Users();
            $users->setEmail("jean$i@gmail.com")
                  ->setPassword("ipo$i")
                  ->setPseudo("geek$i");

            $manager->persist($users);
        }
        $manager->flush();
    }
}
