<?php

namespace App\Controller;
use App\Entity\User;
use App\Controller\InfoController;
use App\Controller\UserController;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CVController extends AbstractController
{

    #[Route('/CV/{id}', name: 'CVof')]
    public function UserCV(user $user, UserRepository $userRepo): Response
    {
        // define an empty user to not have error 
        $user = null;
        // If someone is connected, his token will be inserted in user variable
        if ($this->get('security.token_storage')->getToken()) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
        }

        $dataOfUser = $userRepo->findOneBy(['id'=> $user]);
        // ----------------------------------------
        return $this->render('cv/index.html.twig', [
            'user' => $user,
        ]);
    }
}
