<?php

namespace App\Controller;

use App\Entity\Device;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DeviceController extends AbstractController
{
    /**
     * @Route("/device", name="device")
     */
    public function index()
    {
        return $this->render('device/index.html.twig', [
            'controller_name' => 'DeviceController',
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN_USER")
     * @Route("/device/create", name="create_device")
     * @param Request $request
     * @return Response
     */
    public function createDevice(Request $request)
    {
        $device = new Device();
        $form = $this
            ->createFormBuilder($device)
            ->add('Phone', TextType::class,
                ['required'=> true,
                 'label'=> 'Марка телефона',
                 'attr'=>[
                     'placeholder' => 'iPhone'
                 ]
                ])
            ->add('Model', TextType::class,
                ['required'=> true,
                    'label'=> 'Модель телефона',
                    'attr'=>[
                        'placeholder' => 'X'
                    ]
                ])
            ->add('Producer', TextType::class,
                ['required'=> true,
                    'label'=> 'Страна производитель',
                    'attr'=>[
                        'placeholder' => 'China'
                    ]
                ])
            ->add('Display', TextType::class,
                ['required'=> false,
                    'label'=> 'Диагональ экрана в дюймах',
                    'attr'=>[
                        'placeholder' => '5.5'
                    ]
                ])
            ->add('Price',MoneyType::class,
                ['required'=> true,

                    'label'=> 'Цена, руб',
                    'attr'=>[
                        'currency' => 'RUB',
                        'placeholder' => '50000'
                    ]
                ])
            ->add('MemorySize', IntegerType::class,
                ['required'=> false,
                    'label'=> 'Память устройства в Гб',
                    'attr'=>[
                        'placeholder' => '16'
                    ]
                ])
            ->add('save', SubmitType::class, [
                'label' => "Сохранить"
            ])
            ->getForm()
            ;

        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($device);
            $manager->flush();

            return $this->redirectToRoute('device_list');
        }

        return $this->render(
            'device/create.html.twig',
            ["form" => $form->createView()]
        );
    }

    /**
     * @Route("/device/{device}", requirements={"devices"="\d+"}, name="device_show")
     * @param Device $device
     * @return Response
     */
    public function show(Device $device)
    {
//        $device = $this->getDoctrine()
//            ->getRepository(Device::class)
//            ->find($id);
//
//        if (!$device) {
//            throw $this->createNotFoundException(
//                'No product found for id ' . $id
//            );
//        }
//        $phone = $device->getPhone();
//        $model = $device->getModel();
//        $producer = $device->getProducer();
//        $price = $device->getPrice();
//        $display = $device->getDisplay();
//        $memory_size = $device->getMemorySize();

        //return new Response('Информация о продукте '.$device->getModel());

        // or render a template
        // in the template, print things with {{ product.name }}
        return $this->render('device/show.html.twig', [
            'device' => $device
//            'phone' => $phone,
//            'model' => $model,
//            'display' => $display,
//            'price' => $price,
//            'memory_size' => $memory_size,
//            'producer' => $producer
        ]);
    }

    /**
     * @Route("/device/edit/{id}")
     */
    public function update($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $device = $entityManager->getRepository(Device::class)->find($id);

        if (!$device) {
            throw $this->createNotFoundException(
                'No device found for id ' . $id
            );
        }

        $device->setPhone('SaMsUNG');
        $entityManager->flush();

        return $this->redirectToRoute('device_show', [
            'id' => $device->getId()
        ]);
    }

    /**
     * @Route("/deviceList", name="device_list")
     */
    public function deviceList()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Device::class);
        $devices = $repository->findAll();
        return $this->render(
            'device/list.html.twig',
            ["devices" => $devices]
        );


    }


}
