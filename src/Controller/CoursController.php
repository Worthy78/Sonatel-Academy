<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/cours")
 */
class CoursController extends AbstractController
{
    /**
     * @Route("/", name="cours_index", methods={"GET"})
     */
    public function index(CoursRepository $coursRepository): Response
    {
        return $this->render('cours/index.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin", name="index_admin", methods={"GET"})
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function indexAdmin(CoursRepository $coursRepository): Response
    {
        return $this->render('cours/index_admin.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cours_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $file = $cour->getPhoto();
          $fileName = md5(uniqid()).'.'.$file->guessExtension();
          $file->move($this->getParameter('upload_cours'), $fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $cour->setPhoto($fileName);
            $entityManager->persist($cour);
            $entityManager->flush();

            return $this->redirectToRoute('cours_index');
        }

        return $this->render('cours/new.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cours_show", methods={"GET"})
     */
    public function show(Cours $cour, CoursRepository $coursRepository): Response
    {
     //   $modules = $this->$coursRepository->findBy('module'== $cour->getModule());
        return $this->render('cours/show.html.twig', [
            'cour' => $cour,
            'cours' => $coursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/detail/{id}", name="cours_show_details", methods={"GET"})
     */
    public function showDetails(Cours $cour, CoursRepository $coursRepository): Response
    {
        //   $modules = $this->$coursRepository->findBy('module'== $cour->getModule());
        return $this->render('cours/show_details_front.html.twig', [
            'cour' => $cour,
            'cours' => $coursRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="cours_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cours $cour): Response
    {
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cours_index', [
                'id' => $cour->getId(),
            ]);
        }

        return $this->render('cours/edit.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cours_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cours $cour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cours_index');
    }
}
