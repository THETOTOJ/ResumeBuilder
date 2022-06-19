<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Hobbies;
use App\Entity\Skills;
use App\Entity\Jobs;
use App\Entity\Diplomas;
use App\Form\JobsType;
use App\Form\DiplomasType;
use App\Form\EditProfileType;
use App\Form\SkillsType;
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
   
    #[Route('/user/hobby', name: 'Edit Hobby')]
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
            return $this->redirectToRoute('Edit Hobby');
        }


        return $this->render('user/info/addhobby    .html.twig',[
            'form1' => $form->createView(),
        ]
    
    );
    }

    #[Route('/user/jobs', name: 'Edit Jobs')]
    public function AddJobs(Request $request): Response
    {
        
        $jobs = new jobs;
        $form = $this->createForm(JobsType::class, $jobs);
        $form->handleRequest($request);

        if(
            $form->isSubmitted() && $form->isValid()
        ){
            $jobs->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($jobs);
            $em->flush();
            $this->addFlash('message', 'Job Added');
            return $this->redirectToRoute('Edit Jobs');
        }


        return $this->render('user/info/addjob.html.twig',[
            'form3' => $form->createView(),
        ]
    
    );
    }
    #[Route('/user/diplomas', name: 'Edit Diplomas')]
    public function AddDiplomas(Request $request): Response
    {
        
        $diplomas = new diplomas;
        $form = $this->createForm(DiplomasType::class, $diplomas);
        $form->handleRequest($request);

        if(
            $form->isSubmitted() && $form->isValid()
        ){
            $diplomas->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($diplomas);
            $em->flush();
            $this->addFlash('message', 'Diploma Added');
            return $this->redirectToRoute('Edit Diplomas');
        }


        return $this->render('user/info/adddiploma.html.twig',[
            'form4' => $form->createView(),
        ]
    
    );
    }


    #[Route('/user/skills', name: 'Edit Skills')]
    public function AddSkill(Request $request): Response
    {
        
        $skills = new skills;
        $form = $this->createForm(SkillsType::class, $skills);
        $form->handleRequest($request);

        if(
            $form->isSubmitted() && $form->isValid()
        ){
            $skills->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($skills);
            $em->flush();
            $this->addFlash('message', 'Skill Added');
            return $this->redirectToRoute('Edit Skills');
        }


        return $this->render('user/info/addskill.html.twig',[
            'form' => $form->createView(),
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
