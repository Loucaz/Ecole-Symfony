<?php

namespace App\Controller;

use App\Entity\CarnetDeCorrespondance;
use App\Form\CarnetDeCorrespondanceType;
use App\Repository\CarnetDeCorrespondanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/carnet/de/correspondance")
 */
class CarnetDeCorrespondanceController extends AbstractController
{
    /**
     * @Route("/", name="carnet_de_correspondance_index", methods={"GET"})
     */
    public function index(CarnetDeCorrespondanceRepository $carnetDeCorrespondanceRepository): Response
    {
        return $this->render('carnet_de_correspondance/index.html.twig', [
            'carnet_de_correspondances' => $carnetDeCorrespondanceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="carnet_de_correspondance_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carnetDeCorrespondance = new CarnetDeCorrespondance();
        $form = $this->createForm(CarnetDeCorrespondanceType::class, $carnetDeCorrespondance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carnetDeCorrespondance);
            $entityManager->flush();

            return $this->redirectToRoute('carnet_de_correspondance_index');
        }

        return $this->render('carnet_de_correspondance/new.html.twig', [
            'carnet_de_correspondance' => $carnetDeCorrespondance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carnet_de_correspondance_show", methods={"GET"})
     */
    public function show(CarnetDeCorrespondance $carnetDeCorrespondance): Response
    {
        return $this->render('carnet_de_correspondance/show.html.twig', [
            'carnet_de_correspondance' => $carnetDeCorrespondance,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carnet_de_correspondance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CarnetDeCorrespondance $carnetDeCorrespondance): Response
    {
        $form = $this->createForm(CarnetDeCorrespondanceType::class, $carnetDeCorrespondance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carnet_de_correspondance_index');
        }

        return $this->render('carnet_de_correspondance/edit.html.twig', [
            'carnet_de_correspondance' => $carnetDeCorrespondance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carnet_de_correspondance_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CarnetDeCorrespondance $carnetDeCorrespondance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carnetDeCorrespondance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carnetDeCorrespondance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carnet_de_correspondance_index');
    }
}
