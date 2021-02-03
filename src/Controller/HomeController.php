<?php

namespace App\Controller;

use App\Repository\AdministrativeRepository;
use App\Repository\CompetenceRepository;
use App\Repository\FormationRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     * @param FormationRepository $formationRepository
     * @param CompetenceRepository $compentenceRepository
     * @param AdministrativeRepository $administrativeRepository
     * @param ProjectRepository $projectRepository
     * @return void
     */
    public function index(
        FormationRepository $formationRepository,
        CompetenceRepository $compentenceRepository,
        AdministrativeRepository $administrativeRepository,
        ProjectRepository $projectRepository) {
        return $this->render('home/index.html.twig', [
            'formations'=>$formationRepository->findAll(),
            'competences'=>$compentenceRepository->findAll(),
            'administratives'=>$administrativeRepository->findAll(),
            'projects'=>$projectRepository->findAll(),
]);
    }
}
