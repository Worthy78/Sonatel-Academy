<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/front", name="front")
     */
    public function index()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/front/cours", name="cours")
     */
    public function allCour()
    {
        return $this->render('front/cours/index.html.twig');
    }

    /**
     * @Route("/front/cours/dev", name="cours_dev")
     */
    public function devCour()
    {
        return $this->render('front/cours/dev.html.twig');
    }

    /**
     * @Route("/front/cours/ref", name="cours_ref")
     */
    public function refCour()
    {
        return $this->render('front/cours/ref.html.twig');
    }

    /**
     * @Route("/front/cours/data", name="cours_data")
     */
    public function dataCour()
    {
        return $this->render('front/cours/data.html.twig');
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
}
