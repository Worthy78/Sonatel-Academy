<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Event;
use App\Entity\Apprenant;
use App\Entity\Partenaire;
use App\Entity\Candidature;
use App\Form\CandidatureType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front")
     */
    public function index()
    {
        $partenaires = $this->getDoctrine()->getRepository(Partenaire::class)->findAll();
        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();
        return $this->render('front/index.html.twig', [
            'partenaires'=>$partenaires,
            'events' => $events
        ]);
    }

    /**
    * @Route("front/cvtheque", name="cvtheque")
    */
    public function cvtheque(){
      $apprenants = $this->getDoctrine()->getRepository(Apprenant::class)->findAll();

      return $this->render('front/cvtheque/index.html.twig', [
          'apprenants'=>$apprenants
      ]);
    }

    /**
     * @Route("/front/cours", name="cours")
     */
    public function allCour()
    {
        $cours = $this->getDoctrine()->getRepository(Cours::class)->findAll();

        return $this->render('front/cours/index.html.twig', [
            'cours'=>$cours
        ]);
    }

    /**
     * @Route("/front/cours/dev", name="cours_dev")
     */
    public function devCour()
    {
        $cours = $this->getDoctrine()->getRepository(Cours::class)->findAll();
        return $this->render('front/cours/dev.html.twig', [
            'cours'=>$cours
        ]);
    }

    /**
     * @Route("/front/cours/ref", name="cours_ref")
     */
    public function refCour()
    {
        $cours = $this->getDoctrine()->getRepository(Cours::class)->findAll();
        return $this->render('front/cours/ref.html.twig', [
            'cours'=>$cours
        ]);
    }

    /**
     * @Route("/front/cours/data", name="cours_data")
     */
    public function dataCour()
    {
        $cours = $this->getDoctrine()->getRepository(Cours::class)->findAll();
        return $this->render('front/cours/data.html.twig', [
            'cours'=>$cours
        ]);
    }

    /**
     * @Route("/front/blog", name="blog")
     */
    public function blog()
    {
        return $this->render('front/blog/index.html.twig');
    }

    /**
     * @Route("/front/blog/post", name="blog_post")
     */
    public function postBlog()
    {
        return $this->render('front/blog/post.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('front/page-contact.html.twig');
    }

    /**
     * @Route("/candidature", name="candidature", methods={"GET","POST"})
     */
    public function candidature(Request $request): Response
    {
        $candidature = new Candidature();
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($candidature);
            $entityManager->flush();

            return $this->redirectToRoute('filiere_index');
        }

        return $this->render('front/candidature.html.twig', [
            'candidat' => $candidature,
            'form' => $form->createView(),
        ]);
    }
}
