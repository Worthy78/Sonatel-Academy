<?php

namespace App\Controller;

use App\Entity\AbonneNewlester;
use App\Form\AbonneNewlesterType;
use App\Repository\AbonneNewlesterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/abonne/newlester")
 */
class AbonneNewlesterController extends AbstractController
{
    /**
     * @Route("/", name="abonne_newlester_index", methods={"GET"})
     */
    public function index(AbonneNewlesterRepository $abonneNewlesterRepository): Response
    {
        return $this->render('abonne_newlester/index.html.twig', [
            'abonne_newlesters' => $abonneNewlesterRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="abonne_newlester_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $abonneNewlester = new AbonneNewlester();

        if ($request->isMethod('post')) {
            $entityManager = $this->getDoctrine()->getManager();
            $email = $request->get('email');
            $abonneNewlester->setEmail($email);
            $abonneNewlester->setDate(new\DateTime('now'));
            $entityManager->persist($abonneNewlester);
            $entityManager->flush();

            return $this->redirectToRoute('front');
        }

       return $this->redirectToRoute('front');

    }

    /**
     * @Route("/{id}", name="abonne_newlester_show", methods={"GET"})
     */
    public function show(AbonneNewlester $abonneNewlester): Response
    {
        return $this->render('abonne_newlester/show.html.twig', [
            'abonne_newlester' => $abonneNewlester,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="abonne_newlester_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AbonneNewlester $abonneNewlester): Response
    {
        $form = $this->createForm(AbonneNewlesterType::class, $abonneNewlester);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('abonne_newlester_index', [
                'id' => $abonneNewlester->getId(),
            ]);
        }

        return $this->render('abonne_newlester/edit.html.twig', [
            'abonne_newlester' => $abonneNewlester,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="abonne_newlester_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AbonneNewlester $abonneNewlester): Response
    {
        if ($this->isCsrfTokenValid('delete'.$abonneNewlester->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($abonneNewlester);
            $entityManager->flush();
        }

        return $this->redirectToRoute('abonne_newlester_index');
    }
}
