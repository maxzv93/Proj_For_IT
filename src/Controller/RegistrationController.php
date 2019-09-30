<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('device_list');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/createadmin", name="generate_new_admin")
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function createNewAdmin(UserPasswordEncoderInterface $encoder)
    {
        $admin = new User();
         $admin->setEmail("admin@admin.ru");
        $password ="admin";
        $admin->setPassword($encoder->encodePassword($admin, $password));

        $admin->setRoles(array("ROLE_ADMIN_USER","ROLE_USER"));

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($admin);
        $manager->flush();

        return new Response("Создан новый пользователь с логином: "
            .$admin->getEmail()." и паролем: ".$password.".");
    }
}
