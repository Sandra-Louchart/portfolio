<?php

namespace App\Controller;

use App\Entity\Administrative;
use App\Form\AdministrativeType;
use App\Repository\AdministrativeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/administrative")
 */
class AdministrativeController extends AbstractController
{
    /**
     * @Route("/", name="administrative_index", methods={"GET"})
     * @param AdministrativeRepository $administrativeRepository
     * @return Response
     */
    public function index(AdministrativeRepository $administrativeRepository): Response
    {
        return $this->render('/admin/administrative/index.html.twig', [
            'administratives' => $administrativeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="administrative_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $administrative = new Administrative();
        $form = $this->createForm(AdministrativeType::class, $administrative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($administrative);
            $entityManager->flush();

            return $this->redirectToRoute('administrative_index');
        }

        return $this->render('/admin/administrative/new.html.twig', [
            'administrative' => $administrative,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="administrative_show", methods={"GET"})
     * @param Administrative $administrative
     * @return Response
     */
    public function show(Administrative $administrative): Response
    {
        return $this->render('/admin/administrative/show.html.twig', [
            'administrative' => $administrative,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="administrative_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Administrative $administrative
     * @return Response
     */
    public function edit(Request $request, Administrative $administrative): Response
    {
        $form = $this->createForm(AdministrativeType::class, $administrative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administrative_index');
        }

        return $this->render('admin/administrative/edit.html.twig', [
            'administrative' => $administrative,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="administrative_delete", methods={"DELETE"})
     * @param Request $request
     * @param Administrative $administrative
     * @return Response
     */
    public function delete(Request $request, Administrative $administrative): Response
    {
        if ($this->isCsrfTokenValid('delete'.$administrative->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($administrative);
            $entityManager->flush();
        }

        return $this->redirectToRoute('administrative_index');
    }
}
