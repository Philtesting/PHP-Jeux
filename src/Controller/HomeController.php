<?php

namespace App\Controller;


use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class HomeController  extends AbstractController
{
    /**
     * @Route("/",name="home")
     */
    public function home(EntityManagerInterface $em): Response
    {  
        $repo = $em->getRepository(Media::class); //récuperer le repo
        $allMedias = $repo->findAll(); // récupérer tous les medias


        return $this->render('media/index.html.twig', [
            'controller_name' => 'MediaController' , 'medias' => $allMedias

            
        ]);


    }



    /**
     * @Route("/create", name="createMedia", methods={"GET", "POST"})
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $media = new Media ;
        $form = $this->createFormBuilder($media)
            ->add('titre' , null)
            ->add('description' , null)
            ->add('imagename', FileType::class, [
                    'label' => 'Choisir un fichier'
                ])
            ->add('submit' , SubmitType::class, ['label'=> 'create Media'])
            ->getForm()
        ;

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())  {
            $file = $media->getImageName();

            $fileName = md5(uniqid()).'.'.$file->guessClientExtension();
            
            $file->move($this->getParameter('upload_directory'), $fileName);
            $media->setImageName($fileName);

            $em->persist($media);
            $em->flush();
            

            return $this->redirect('/');

        }

        return $this->render('media/create.html.twig' , [ 'monFormulaire' => $form->createView()
        ]);
    }





    
    /**
     * @Route("/jeux",name="jeux")
     */
    public function listeJeux()
    {
        return $this->render('games/index.html.twig');
    }
}