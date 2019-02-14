<?php

namespace App\Controller;

use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
