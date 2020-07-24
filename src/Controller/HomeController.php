<?php

namespace App\Controller;

use App\Repository\HomeMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [

        ]);
    }

    /**
     * @Route("/accueil", name="hard")
     * @param HomeMessageRepository $homeMessageRepository
     * @return Response
     */
    public function indexHard(HomeMessageRepository $homeMessageRepository)
    {
        return $this->render('home/hard.html.twig', [
            'messages' => $homeMessageRepository->findAll(),
        ]);
    }

}
