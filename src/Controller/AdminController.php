<?php

namespace App\Controller;

use App\Repository\AdministrativeRepository;
use App\Repository\CompetenceRepository;
use App\Repository\FormationRepository;
use App\Repository\ProjectRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 * @Route("/admin", name="admin_")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param AdministrativeRepository $administrativeRepository
     * @param CompetenceRepository $competenceRepository
     * @param FormationRepository $formationRepository
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function index(AdministrativeRepository $administrativeRepository, CompetenceRepository $competenceRepository, FormationRepository $formationRepository,
ProjectRepository $projectRepository)
    {
        return $this->render('admin/index.html.twig', [
            'formations'=>$formationRepository->findAll(),
            'competences'=>$competenceRepository->findAll(),
            'administratives'=>$administrativeRepository->findAll(),
            'projects'=>$projectRepository->findAll(),
        ]);
    }
}