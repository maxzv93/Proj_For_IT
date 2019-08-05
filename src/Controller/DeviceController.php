<?php

namespace App\Controller;

use App\Entity\Device;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
     * @Route("/", name="device")
     */
    public function index()
    {
        return $this->redirectToRoute('device_list');
//        return $this->render('device/index.html.twig', [
//            'controller_name' => 'DeviceController',
//        ]);
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
                ['required' => true,
                    'label' => 'Марка телефона',
                    'attr' => [
                        'placeholder' => 'iPhone'
                    ]
                ])
            ->add('Model', TextType::class,
                ['required' => true,
                    'label' => 'Модель телефона',
                    'attr' => [
                        'placeholder' => 'X'
                    ]
                ])
            ->add('Producer', TextType::class,
                ['required' => true,
                    'label' => 'Страна производитель',
                    'attr' => [
                        'placeholder' => 'China'
                    ]
                ])
            ->add('Display', TextType::class,
                ['required' => false,
                    'label' => 'Диагональ экрана в дюймах',
                    'attr' => [
                        'placeholder' => '5.5'
                    ]
                ])
            ->add('Price', MoneyType::class,
                ['required' => true,

                    'label' => 'Цена, руб',
                    'attr' => [
                        'currency' => 'RUB',
                        'placeholder' => '50000'
                    ]
                ])
            ->add('MemorySize', IntegerType::class,
                ['required' => false,
                    'label' => 'Память устройства в Гб',
                    'attr' => [
                        'placeholder' => '16'
                    ]
                ])
            ->add('RefPicture', TextType::class,
                ['required' => false,
                    'label' => 'Ссылка на картинку',
                    'attr' => [
                        'placeholder' => 'http//...../'
                    ]
                ])
            ->add('save', SubmitType::class, [
                'label' => "Сохранить"
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
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
//        $device = new Device();
//        $form = $this
//            ->createFormBuilder($device)
//            ->add('Phone', TextType::class,
//                ['required' => true,
//                    'label' => 'Марка',
//                    'attr' => [
//                        'placeholder' => 'e.g. SAMSUNG'
//                    ]
//                ])
//            ->add('save', SubmitType::class, [
//                'label' => "Сохранить"
//            ])
//            ->getForm();
//        $form->handleRequest($request);
//            ->add('find', SubmitType::class, [
//                'label' => "Поиск"
//            ])
//            ->getForm();
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
            'device' => $device//,
//            "form" => $form->createView()
//            'phone' => $phone,
//            'model' => $model,
//            'display' => $display,
//            'price' => $price,
//            'memory_size' => $memory_size,
//            'producer' => $producer
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN_USER")
     * @Route("/device/edit/{id}", requirements={"id"="\d+"}, name="device_edit")
     * @param Device $device
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function deviceUpdate(Device $device,Request $request)//Request $request,$id)
    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $device = $entityManager->getRepository(Device::class)->find($id);
//
//        if (!$device) {
//            throw $this->createNotFoundException(
//                'No device found for id ' . $id
//            );
//        }
//
//        $device->setPhone('SAMSUNG');
//        $entityManager->flush();
//
//        return $this->redirectToRoute('device_show', [
//            'device' => $device->getId()
//        ]);

        $form = $this
            ->createFormBuilder($device)
            ->add('Phone', TextType::class,
                ['required' => true,
                    'label' => 'Марка телефона',
                    'attr' => [
                        'placeholder' => 'iPhone'
                    ]
                ])
            ->add('Model', TextType::class,
                ['required' => true,
                    'label' => 'Модель телефона',
                    'attr' => [
                        'placeholder' => 'X'
                    ]
                ])
            ->add('Producer', TextType::class,
                ['required' => true,
                    'label' => 'Страна производитель',
                    'attr' => [
                        'placeholder' => 'China'
                    ]
                ])
            ->add('Display', TextType::class,
                ['required' => false,
                    'label' => 'Диагональ экрана в дюймах',
                    'attr' => [
                        'placeholder' => '5.5'
                    ]
                ])
            ->add('Price', MoneyType::class,
                ['required' => true,

                    'label' => 'Цена, руб',
                    'attr' => [
                        'currency' => 'RUB',
                        'placeholder' => '50000'
                    ]
                ])
            ->add('MemorySize', IntegerType::class,
                ['required' => false,
                    'label' => 'Память устройства в Гб',
                    'attr' => [
                        'placeholder' => '16'
                    ]
                ])
            ->add('RefPicture', TextType::class,
                ['required' => false,
                    'label' => 'Ссылка на картинку',
                    'attr' => [
                        'placeholder' => 'http//...../'
                    ]
                ])
            ->add('isDelete', CheckboxType::class,
                ['required' => false,
                    'label' => 'Удалить',
                ])
            ->add('save', SubmitType::class, [
                'label' => "Сохранить"
            ])
            ->getForm();

        $form->handleRequest($request);
//        if ($device->getIsDelete() == true)
//        {
//            return $this->json($device->getIsDelete());
//        }

        if ($form->isSubmitted() and $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($device);
            $manager->flush();

            return $this->redirectToRoute('device_list');
        }


        return $this->render(
            'device/edit.html.twig',
            [
                "form" => $form->createView()//,
//             "device" => $device->getIsDelete()
            ]);
    }

    /**
     * @Route("/deviceList", name="device_list")
     * @param Request $request
     */
    public function deviceList(Request $request)
    {

        $defaultData = ['message' => 'your message here'];
        $form = $this->createFormBuilder($defaultData)
            ->add('Phone', TextType::class,[
                'required' => false,
                'label' => 'Производитель'])
            ->add('MinVol', IntegerType::class,[
                'required' => false,
                'label' => 'Минимальный объем памяти'])
            ->add('MaxVol', IntegerType::class,[
                'required' => false,
                'label' => 'Максимальный объем памяти'])
            ->add('MinPrice', IntegerType::class,[
                'required' => false,
                'label' => 'Минимальная цена'])
            ->add('MaxPrice', IntegerType::class,[
                'required' => false,
                'label' => 'Максимальная цена'])
            ->add('send', SubmitType::class,['label' => 'Поиск'])
            ->getForm();

        $form->handleRequest($request);
        $data = $form->getData();

        if ($form->isSubmitted() && $form->isValid() &&
            (($data['Phone']!="") || ($data['MinPrice']!="") || ($data['MaxPrice']!="")
                || ($data['MinVol']!="") || ($data['MaxVol']!=""))
        )
        {

            $devices= $this->getDoctrine()
                ->getRepository(Device::class)->findAllEqualToPhone($data);

        }
        else{
            $repository = $this->getDoctrine()
                ->getRepository(Device::class);
            $devices = $repository->findAll();
        }

//        $data = $form->getData();
//
//        $form->handleRequest($request);
//        $request->request->get('Phone');
//        dd($data);


//        $repository = $this->getDoctrine()
//            ->getRepository(Device::class);
//        $devices = $repository->findAll();
        return $this->render(
            'device/list.html.twig',
            ["devices" => $devices,
             "form" => $form->createView()
            ]
        );
    }

    /**
     * @Route("/device/edit/{id}/delete", requirements={"id"="\d+"}, name="device_delete")
     */
    public function deleteDevice($id)
    {

    }



}
