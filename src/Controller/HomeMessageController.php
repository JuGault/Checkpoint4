<?php

namespace App\Controller;

use App\Entity\HomeMessage;
use App\Form\HomeMessageType;
use App\Repository\HomeMessageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/accueil")
 * @IsGranted("ROLE_ADMIN")
 */
class HomeMessageController extends AbstractController
{
    /**
     * @Route("/", name="home_message_index", methods={"GET"})
     */
    public function index(HomeMessageRepository $homeMessageRepository): Response
    {
        return $this->render('home_message/index.html.twig', [
            'home_messages' => $homeMessageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="home_message_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $homeMessage = new HomeMessage();
        $form = $this->createForm(HomeMessageType::class, $homeMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($homeMessage);
            $entityManager->flush();

            return $this->redirectToRoute('home_message_index');
        }

        return $this->render('home_message/new.html.twig', [
            'home_message' => $homeMessage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="home_message_show", methods={"GET"})
     */
    public function show(HomeMessage $homeMessage): Response
    {
        return $this->render('home_message/show.html.twig', [
            'home_message' => $homeMessage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="home_message_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HomeMessage $homeMessage): Response
    {
        $form = $this->createForm(HomeMessageType::class, $homeMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home_message_index');
        }

        return $this->render('home_message/edit.html.twig', [
            'home_message' => $homeMessage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="home_message_delete", methods={"DELETE"})
     */
    public function delete(Request $request, HomeMessage $homeMessage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$homeMessage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($homeMessage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home_message_index');
    }
}
