<?php

namespace App\Controller;

use App\Entity\ObjetCarnet;
use App\Form\ObjetCarnetType;
use App\Repository\ObjetCarnetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/objet/carnet")
 */
class ObjetCarnetController extends AbstractController
{
    /**
     * @Route("/", name="objet_carnet_index", methods={"GET"})
     */
    public function index(ObjetCarnetRepository $objetCarnetRepository): Response
    {
        return $this->render('objet_carnet/index.html.twig', [
            'objet_carnets' => $objetCarnetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="objet_carnet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $objetCarnet = new ObjetCarnet();
        $form = $this->createForm(ObjetCarnetType::class, $objetCarnet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($objetCarnet);
            $entityManager->flush();

            return $this->redirectToRoute('objet_carnet_index');
        }

        return $this->render('objet_carnet/new.html.twig', [
            'objet_carnet' => $objetCarnet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objet_carnet_show", methods={"GET"})
     */
    public function show(ObjetCarnet $objetCarnet): Response
    {
        return $this->render('objet_carnet/show.html.twig', [
            'objet_carnet' => $objetCarnet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="objet_carnet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ObjetCarnet $objetCarnet): Response
    {
        $form = $this->createForm(ObjetCarnetType::class, $objetCarnet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('objet_carnet_index');
        }

        return $this->render('objet_carnet/edit.html.twig', [
            'objet_carnet' => $objetCarnet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objet_carnet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ObjetCarnet $objetCarnet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$objetCarnet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($objetCarnet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('objet_carnet_index');
    }
}
