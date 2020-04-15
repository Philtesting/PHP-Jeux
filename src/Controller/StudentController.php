<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /** 
     * @Route("/student/ajax") 
    */ 
    public function ajaxAction(Request $request, UsersRepository $userBD) {  
        $students = $userBD->findAll();  
        
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {  
        $jsonData = array();  
        $idx = 0;  
        foreach($students as $student) {  
            $temp = array(
                'name' => $student->getUsername(),  
                'address' => $student->getEmail(),  
            );   
            $jsonData[$idx++] = $temp;  
        } 
            return new JsonResponse($jsonData); 
        } else { 
        return $this->render('student/index.html.twig'); 
        } 
    }

    /** 
     * @Route("/test") 
    */ 
    public function test() {  
        return $this->render('student/test.html.twig'); 
    } 


}
