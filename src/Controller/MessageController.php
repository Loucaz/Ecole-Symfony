<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageRepondre;
use App\Form\MessageType;
use App\Form\UserType;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/message")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/", name="message_index", methods={"GET"})
     */
    public function index(MessageRepository $messageRepository): Response
    {
        return $this->render('message/index.html.twig', [
            'messages' => $messageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/user{id}", name="message_index", methods={"GET"})
     */
    public function listeMessageParUser(MessageRepository $messageRepository, $id): Response
    {
        return $this->render('message/index.html.twig', [
            'messages' => $messageRepository->findByUser($id),
            'idUser' => $id,
        ]);
    }

    /**
     * @Route("/newMessage{id}User{idUser}", name="message_repondre", methods={"GET","POST"})
     */
    public function repondre(Request $request, MessageRepository $messageRepository, $idUser, $id): Response
    {
        $message = new Message();
        $message = $messageRepository->findById($id);
        $tmp = $message->getDestinataire();
        $message->setContenu(null);
        $message->setTitre(null);
        $message->setDestinataire($message->getEnvoyeur());
        $message->setEnvoyeur($tmp);



        $form = $this->createForm(MessageRepondre::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('message_index', ['id' => $idUser]);
        }



        return $this->render('message/repondre.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
            'idUser' => $idUser,
            'id' => $id,
        ]);
    }

    /**
     * @Route("/newUser{idUser}", name="message_new", methods={"GET","POST"})
     */
    public function new(Request $request, $idUser, UserRepository $userRepository): Response
    {
        $message = new Message();
        $user = $userRepository->findById($idUser);
        $message->setEnvoyeur($user);
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('message_index', ['id' => $idUser]);
        }

        return $this->render('message/new.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
            'idUser' => $idUser,
        ]);
    }

    /**
     * @Route("/{id}{idUser}", name="message_show", methods={"GET"})
     */
    public function show(Message $message, $idUser): Response
    {
        return $this->render('message/show.html.twig', [
            'message' => $message,
            'idUser' => $idUser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="message_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Message $message): Response
    {
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('message_index');
        }

        return $this->render('message/edit.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="message_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Message $message): Response
    {
        if ($this->isCsrfTokenValid('delete'.$message->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($message);
            $entityManager->flush();
        }

        return $this->redirectToRoute('message_index');
    }
}
