<?php

namespace App\Controller;

use App\Entity\PhotoDeClasse;
use App\Form\PhotoDeClasseType;
use App\Repository\PhotoDeClasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/photo/de/classe")
 */
class PhotoDeClasseController extends AbstractController
{
    /**
     * @Route("/", name="photo_de_classe_index", methods={"GET"})
     */
    public function index(PhotoDeClasseRepository $photoDeClasseRepository): Response
    {
        return $this->render('photo_de_classe/index.html.twig', [
            'photo_de_classes' => $photoDeClasseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="photo_de_classe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $photoDeClasse = new PhotoDeClasse();
        $form = $this->createForm(PhotoDeClasseType::class, $photoDeClasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($photoDeClasse);
            $entityManager->flush();

            return $this->redirectToRoute('photo_de_classe_index');
        }

        return $this->render('photo_de_classe/new.html.twig', [
            'photo_de_classe' => $photoDeClasse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="photo_de_classe_show", methods={"GET"})
     */
    public function show(PhotoDeClasse $photoDeClasse): Response
    {
        return $this->render('photo_de_classe/show.html.twig', [
            'photo_de_classe' => $photoDeClasse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="photo_de_classe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PhotoDeClasse $photoDeClasse): Response
    {
        $form = $this->createForm(PhotoDeClasseType::class, $photoDeClasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('photo_de_classe_index');
        }

        return $this->render('photo_de_classe/edit.html.twig', [
            'photo_de_classe' => $photoDeClasse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="photo_de_classe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PhotoDeClasse $photoDeClasse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$photoDeClasse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($photoDeClasse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('photo_de_classe_index');
    }
}
