<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer): Response
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*%/";

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $psswd = substr( str_shuffle( $chars ), 0, 8 );
            $password = $passwordEncoder->encodePassword($user, $psswd);
            $user->setPassword($password);
            $user->setMatricule('tmp32758');
            $user->setRoles(['ROLE_ADMIN']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $message = (new \Swift_Message('Sonatel Academy'))
                ->setFrom('aumonesmailer@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                        'registration/mail.html.twig', [
                            'email' => $user->getEmail(),
                            'password' => $psswd,
                            
                        ]
                    )
                    ,'text/html'
                );

                $rponse = $mailer->send($message);
              


            return $this->redirectToRoute('registration');
        }

        return $this->render('registration/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
