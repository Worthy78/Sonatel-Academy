<?php

namespace App\Controller;

use App\GestionDeslogs;
use App\Entity\Apprenant;
use App\Form\ApprenantType;
use App\Repository\ApprenantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security as Secur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/apprenant")
 */
class ApprenantController extends AbstractController
{
    const INFO = 'info';

     /**
     * @param Secur $security
     */
    public function __construct(GestionDeslogs $logger, Secur $security)
    {
        $this->userLogger = $logger;

        if (is_object($security->getToken()->getUser())) {
            $user = $security->getToken()->getUser();
        }

    }

    public function getRequest()
    {
        return $this->container->get('request_stack')->getCurrentRequest();
    }

    /**
     * @Route("/", name="apprenant_index", methods={"GET"})
     */
    public function index(ApprenantRepository $apprenantRepository): Response
    {
        $this->userLogger->addLogg(self::INFO, $this->getRequest(), $this->getUser(), 'Visualisation de la liste des apprenants.');

        return $this->render('apprenant/index.html.twig', [
            'apprenants' => $apprenantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="apprenant_new", methods={"GET","POST"})
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer): Response
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*%/";
        $apprenant = new Apprenant();
        $form = $this->createForm(ApprenantType::class, $apprenant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $psswd = substr( str_shuffle( $chars ), 0, 8 );
            $password = $passwordEncoder->encodePassword($apprenant->getCompte(), $psswd);
            $apprenant->getCompte()->setPassword($password);
            $apprenant->getCompte()->setMatricule('tmp32758');
            $apprenant->getCompte()->setRoles(['ROLE_APPRENANT']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($apprenant);
            $entityManager->flush();
            $message = (new \Swift_Message('Sonatel Academy'))
                ->setFrom('aumonesmailer@gmail.com')
                ->setTo($apprenant->getCompte()->getEmail())
                ->setBody(
                    $this->renderView(
                        'registration/mail.html.twig', [
                            'email' => $apprenant->getCompte()->getEmail(),
                            'password' => $psswd,
                            
                        ]
                    )
                    ,'text/html'
                );

                $rponse = $mailer->send($message);

            return $this->redirectToRoute('apprenant_index');
        }

        return $this->render('apprenant/new.html.twig', [
            'apprenant' => $apprenant,
            'form' => $form->createView(),
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
