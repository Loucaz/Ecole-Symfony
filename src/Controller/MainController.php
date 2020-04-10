<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_index")
     */
    public function index(AuthenticationUtils $authenticationUtils,ArticleRepository $articleRepository): Response
    {

        return $this->render('main/index.html.twig',[
            'articles' => $articleRepository->findAll(),
        ]);
    }
}