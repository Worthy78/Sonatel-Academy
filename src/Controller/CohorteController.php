<?php

namespace App\Controller;

use App\Entity\Cohorte;
use App\Form\CohorteType;
use App\Repository\CohorteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cohorte")
 */
class CohorteController extends AbstractController
{
    /**
     * @Route("/", name="cohorte_index", methods={"GET"})
     */
    public function index(CohorteRepository $cohorteRepository): Response
    {
        return $this->render('cohorte/index.html.twig', [
            'cohortes' => $cohorteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cohorte_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cohorte = new Cohorte();
        $form = $this->createForm(CohorteType::class, $cohorte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cohorte);
            $entityManager->flush();

            return $this->redirectToRoute('cohorte_index');
        }

        return $this->render('cohorte/new.html.twig', [
            'cohorte' => $cohorte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cohorte_show", methods={"GET"})
     */
    public function show(Cohorte $cohorte): Response
    {
        return $this->render('cohorte/show.html.twig', [
            'cohorte' => $cohorte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cohorte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cohorte $cohorte): Response
    {
        $form = $this->createForm(CohorteType::class, $cohorte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cohorte_index', [
                'id' => $cohorte->getId(),
            ]);
        }

        return $this->render('cohorte/edit.html.twig', [
            'cohorte' => $cohorte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cohorte_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cohorte $cohorte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cohorte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cohorte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cohorte_index');
    }
}
