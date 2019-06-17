<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Event;
use App\Entity\Cohorte;
use App\Form\CoursType;
use App\Form\CohorteType;
use App\Repository\CoursRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @Security("is_granted('ROLE_ADMIN')")
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


     /**
     * @Route("/admin/cohorte", name="cohorte_new", methods={"GET","POST"})
     */
    public function Cohorte(Request $request): Response
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

        return $this->render('admin/cohorte_new.html.twig', [
            'cohorte' => $cohorte,
            'form' => $form->createView(),
        ]);
    }

    
}
