<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Hobbies;
use App\Entity\Skills;
use App\Entity\Jobs;
use App\Entity\Diplomas;
use App\Entity\Lang;
use App\Form\JobsType;
use App\Form\LangType;
use App\Form\DiplomasType;
use App\Form\SkillsType;
use App\Form\HobbiesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfoController extends AbstractController
{
    // HOBBIES
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


        return $this->render('user/info/addhobby.html.twig',[
            'formhobby' => $form->createView(),
        ]
    
    );
    }
    #[Route('/user/hobby/{id}', name: 'hobby_delete', methods: ['POST'])]
    public function deleteHobby(Request $request, Hobbies $hobbies, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hobbies->getId(), $request->request->get('_token'))) {
            $entityManager->remove($hobbies);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Edit Hobby', [], Response::HTTP_SEE_OTHER);
    }
// Lang
    #[Route('/user/lang', name: 'Edit Lang')]
    public function AddLang(Request $request): Response
    {
        
        $lang = new lang;
        $form = $this->createForm(LangType::class, $lang);
        $form->handleRequest($request);

        if(
            $form->isSubmitted() && $form->isValid()
        ){
            $lang->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($lang);
            $em->flush();
            $this->addFlash('message', 'Language Added');
            return $this->redirectToRoute('Edit Lang');
        }


        return $this->render('user/info/addlanguage.html.twig',[
            'formlang' => $form->createView(),
        ]
    
    );
    }
    #[Route('/user/lang/{id}', name: 'lang_delete', methods: ['POST'])]
    public function deleteLang(Request $request, Lang $lang, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lang->getId(), $request->request->get('_token'))) {
            $entityManager->remove($lang);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Edit Lang', [], Response::HTTP_SEE_OTHER);
    }         
    // SKILLS
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
    #[Route('/user/skills/{id}', name: 'skill_delete', methods: ['POST'])]
    public function deleteSkill(Request $request, Skills $skills, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$skills->getId(), $request->request->get('_token'))) {
            $entityManager->remove($skills);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Edit Skills', [], Response::HTTP_SEE_OTHER);
    }
    // JOBS
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
    #[Route('/user/jobs/{id}', name: 'job_delete', methods: ['POST'])]
    public function deleteJobs(Request $request, Jobs $jobs, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobs->getId(), $request->request->get('_token'))) {
            $entityManager->remove($jobs);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Edit Jobs', [], Response::HTTP_SEE_OTHER);
    }

    // DIPLOMAS
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
    #[Route('/user/diplomas/{id}', name: 'diploma_delete', methods: ['POST'])]
    public function delete(Request $request, Diplomas $diplomas, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$diplomas->getId(), $request->request->get('_token'))) {
            $entityManager->remove($diplomas);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Edit Diplomas', [], Response::HTTP_SEE_OTHER);
    }

    
}
