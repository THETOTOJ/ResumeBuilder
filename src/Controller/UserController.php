<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;

class UserController extends AbstractController
{
    #[Route('/', name: 'User')]
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
    #[Route('/user/contact', name: 'app_contact')]
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();

            $message = (new \Swift_Message('Nouveau'))

            ->setFrom('votre@adresse.fr')
            ->setTo($contact['email'])
            ->setBody(
                $this->renderView(
                    'contact/contact.html.twig', compact('contact')
                ),
                'text/html'
            )
            ;
            $mailer->send($message);

            $this->addFlash('message', 'Email Sent');
            return $this->redirectToRoute('app_contact',);
        }

        return $this->render('contact/index.html.twig', [
            'contactform' => $form->createView()
        ]);
    }
}
