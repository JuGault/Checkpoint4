<?php

namespace App\Controller;

use App\Repository\ShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpectacleController extends AbstractController
{
    /**
     * @Route("/spectacle", name="spectacle")
     * @param ShowRepository $showRepository
     * @return Response
     */
    public function index(ShowRepository $showRepository)
    {
        return $this->render('spectacle/index.html.twig', [
            'shows' => $showRepository->findAll()
        ]);
    }
}
