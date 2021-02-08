<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public  function login(AuthenticationUtils $authenticationUtils):Response{
        $errors=$authenticationUtils->getLastAuthenticationError();
        $username=$authenticationUtils->getLastUsername();
        return $this->render('admin/security/login.html.twig',[
            'error'=>$errors,
            'username'=>$username
            ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     * @return Response
     */
    public  function logout():Response{
        // should be blank

    }
}
