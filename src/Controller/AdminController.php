<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/event", name="event")
     */
    public function event(){

        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();

        return $this->render('admin/event.html.twig', [
                'events' => $events
        ]);
    }

    /**
     * @Route("/admin/new", name="cours_new_admin", methods={"GET","POST"})
     */
    public function newCour(Request $request, CoursRepository $coursRepository): Response
    {
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $cour->getPhoto();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_cours'), $fileName);
            $cour->setPhoto($fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cour);
            $entityManager->flush();

            return $this->redirectToRoute('cours_new_admin');
        }

        return $this->render('cours/index_admin.html.twig', [
            'cour' => $cour,
            'form' => $form->createView(),
            'cours' => $coursRepository->findAll(),

        ]);
    }
}
