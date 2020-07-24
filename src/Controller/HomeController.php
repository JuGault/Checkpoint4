<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     */
    public function indexHard()
    {
        return $this->render('home/hard.html.twig', [

        ]);
    }

}