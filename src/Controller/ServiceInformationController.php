<?php

namespace App\Controller;

use App\Entity\ServiceInformation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceInformationController extends AbstractController
{
    /**
     * @Route("/service/information", name="service_information")
     */
    public function index()
    {
        return $this->render('service_information/index.html.twig', [
            'controller_name' => 'ServiceInformationController',
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN_USER")
     * @Route("/contacts/update/{id}", requirements={"id"="\d+"}, name="contacts_update")
     * @param ServiceInformation $information
     * @param Request $request
     * @return Response
     */
    public function updateServiceInformation(ServiceInformation $information, Request $request)
    {
//        $information = new ServiceInformation();
        $form = $this
            ->createFormBuilder($information)
            ->add('Phone1', TextType::class,
                ['required' => true,
                    'label' => 'Номер телефона 1'
                ])
            ->add('Phone2', TextType::class,
                ['required' => true,
                    'label' => 'Номер телефона 2'
                ])
            ->add('Phone3', TextType::class,
                ['required' => true,
                    'label' => 'Номер телефона 3'
                ])
            ->add('Email1', TextType::class,
                ['required' => true,
                    'label' => 'Email 1'
                ])
            ->add('Email2', TextType::class,
                ['required' => true,
                    'label' => 'Email 2'
                ])
            ->add('address1', TextType::class,
                ['required' => true,
                    'label' => 'Адрес организации 1'
                ])
            ->add('address2', TextType::class,
                ['required' => true,
                    'label' => 'Адрес организации 2'
                ])
            ->add('save', SubmitType::class, [
                'label' => "Сохранить"
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($information);
            $manager->flush();

            return $this->redirectToRoute('device_list');
        }

        return $this->render(
            'service_information/update_contacts.html.twig',
            ["form" => $form->createView()]
        );
    }

    /**
     * @IsGranted("ROLE_ADMIN_USER")
     * @Route("/contacts/create", name="contacts_create")
     * @return Response
     */
    public function createServiceInformation()
    {
        $information = new ServiceInformation();

        $information->setPhone1('8 905 433 456 1');
        $information->setPhone2('8 905 433 456 2');
        $information->setPhone3('8 905 433 456 3');
        $information->setEmail1('info@mail.ru');
        $information->setEmail2('info2@mail.ru');
        $information->setAddress1('info2@mail.ru');
        $information->setAddress2('info2@mail.ru');
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($information);
        $manager->flush();

        return $this->redirectToRoute('device_list');
    }


//        $admin = new ServiceInformation();
//        $admin->setEmail("admin@admin.ru");
//        $password ="admin";
//        $admin->setPassword($encoder->encodePassword($admin, $password));
//
//        $admin->setRoles(array("ROLE_ADMIN_USER","ROLE_USER"));
//
//        $manager = $this->getDoctrine()->getManager();
//        $manager->persist($admin);
//        $manager->flush();
//
//        return new Response("Создан новый пользователь с логином: "
//            .$admin->getEmail()." и паролем: ".$password.".");

    /**
     * @Route("/contacts/{information}", requirements={"information"="\d+"}, name="contacts_information")
     * @param ServiceInformation $information
     * @return Response
     */
        public function showServiceInformation(ServiceInformation $information)
    {
        if($information->getId()==1) {
            return $this->render(
                'service_information/contact.html.twig',
                ['information' => $information
                ]);
        }
        else
        {
            return $this->redirectToRoute('device_list');
        }
    }
}
