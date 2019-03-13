<?php

namespace App\Controller;

use App\Entity\Apprenant;
use App\Form\ApprenantType;
use App\Repository\ApprenantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/apprenant")
 */
class ApprenantController extends AbstractController
{
    /**
     * @Route("/", name="apprenant_index", methods={"GET"})
     */
    public function index(ApprenantRepository $apprenantRepository): Response
    {
        return $this->render('apprenant/index.html.twig', [
            'apprenants' => $apprenantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="apprenant_new", methods={"GET","POST"})
     */
    public function new(Request $request, ApprenantRepository $apprenantRepository): Response
    {
        $apprenant = new Apprenant();
        $form = $this->createForm(ApprenantType::class, $apprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file1 = $apprenant->getPhoto();
            $file2 = $apprenant->getCv();
            $fileName1 = md5(uniqid()).'.'.$file1->guessExtension();
            $fileName2 = md5(uniqid()).'.'.$file2->guessExtension();
            $file1->move($this->getParameter('upload_apprenant'), $fileName1);
            $file2->move($this->getParameter('upload_apprenant_cv'), $fileName2);
            $apprenant->setPhoto($fileName1);
            $apprenant->setcv($fileName2);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($apprenant);
            $entityManager->flush();

            return $this->redirectToRoute('apprenant_new');
        }

        return $this->render('apprenant/index_admin.html.twig', [
            'apprenant' => $apprenant,
            'form' => $form->createView(),
            'apprenants' => $apprenantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="apprenant_show", methods={"GET"})
     */
    public function show(Apprenant $apprenant): Response
    {
        return $this->render('apprenant/show.html.twig', [
            'apprenant' => $apprenant,
        ]);
    }

    /**
     * @Route("/{id}/veup", name="apprenant_show_front", methods={"GET"})
     */
    public function showFront(Apprenant $apprenant): Response
    {
        return $this->render('apprenant/show_front.html.twig', [
            'apprenant' => $apprenant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="apprenant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Apprenant $apprenant): Response
    {
        $form = $this->createForm(ApprenantType::class, $apprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('apprenant_index', [
                'id' => $apprenant->getId(),
            ]);
        }

        return $this->render('apprenant/edit.html.twig', [
            'apprenant' => $apprenant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="apprenant_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Apprenant $apprenant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$apprenant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($apprenant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('apprenant_index');
    }
}
