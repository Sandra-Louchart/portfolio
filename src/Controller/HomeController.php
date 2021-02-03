<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

Class HomeController extends AbstractController
{
    /**
     * @Route("/home/", name="home_index")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'website' => 'Portfolio Sandar Louchart',
        ]);
    }
}
