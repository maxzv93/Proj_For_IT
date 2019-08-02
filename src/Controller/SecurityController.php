<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

//use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //    $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        //
        //return new RedirectResponse($this->urlGenerator->generate('device_list'));
        //throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/admin/create/", name="generate_new_admin")
     */
    public function createAdmin(UserPasswordEncoderInterface $encoder)
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
