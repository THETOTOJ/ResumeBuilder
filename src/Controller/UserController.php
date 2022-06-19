<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Hobbies;
use App\Form\EditProfileType;
use App\Form\HobbiesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'User')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig');
    }
   
    #[Route('/user/addhobby', name: 'Add Hobby')]
    public function AddHobby(Request $request): Response
    {
        
        $hobbies = new hobbies;
        $form = $this->createForm(HobbiesType::class, $hobbies);
        $form->handleRequest($request);

        if(
            $form->isSubmitted() && $form->isValid()
        ){
            $hobbies->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($hobbies);
            $em->flush();
            $this->addFlash('message', 'Hobby Added');
            return $this->redirectToRoute('Add Hobby');
        }


        return $this->render('user/info/addhobby.html.twig',[
            'form1' => $form->createView(),
        ]
    
    );
    }
    #[Route('/user/profile/edit', name: 'Edit User')]
    public function EditProfileType(Request $request): Response
    {
        $user = $this->getUser();
        
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);

        if(
            $form->isSubmitted() && $form->isValid()
        ){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profile Updated');
            return $this->redirectToRoute('User');
        }


        return $this->render('user/editProfile.html.twig',[
            'form' => $form->createView(),
        ]
    
    );
    }
}
