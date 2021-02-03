<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home_index")
     * @param FormationRepository $formationRepository
     * @return Response
     */
    public function index(
        FormationRepository $formationRepository) {
        return $this->render('home/index.html.twig', [
            'formations'=>$formationRepository->findAll()
]);
    }
}
