<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditProfileType;
use Doctrine\ORM\EntityManagerInterface;
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
