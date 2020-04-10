<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_index")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('main/index.html.twig');
    }

    /**
     * @Route("/information", name="main_information", methods={"GET"})
     */
    public function contact(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('main/information.html.twig');
    }
}
