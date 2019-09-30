<?php

namespace App\Controller;

use App\Entity\CommentMessage;
use App\Entity\Device;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
     * @Route("", name="device")
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
     * @param Request $request
     * @param Device $device
     * @return Response
     * @throws \Exception
     */
    public function show(Request $request, Device $device)
    {
        // or render a template
        // in the template, print things with {{ product.name }}
        $repository = $this->getDoctrine()
            ->getRepository(CommentMessage::class);
        $comment = $repository->findBy(
            ['item_id' => $device->getId()]
        );
//                dd($comment->created_at());

//        dd($comment);
        $created_at= new \DateTime();
        $created_at->modify('+3 hour');
        $message = new CommentMessage();
        $message->setItemId($device);
        $message->setCreatedAt($created_at);
        if($this->isGranted('ROLE_USER')||$this->isGranted('ROLE_ADMIN_USER'))
            $message->setAuthor($this->getUser()->getEmail());
        else
            $message->setAuthor('ANONYM');


        $form = $this
            ->createFormBuilder($message)
            ->add('message', TextType::class,
                ['required' => true,
                    'label' => 'Новое сообщение',
                    'attr' => [
                        'placeholder' => 'Текст сообщения ... '
                    ]
                ])
            ->add('save', SubmitType::class, [
                'label' => "Отправить"
            ])
            ->getForm();

        $form->handleRequest($request);


        if ($form->isSubmitted() and $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($message);
            $manager->flush();
//            dd($device->getId());
            return $this->redirectToRoute('device_show', ['device' => $device->getId()]);
        }

        return $this->render('device/show.html.twig', [
            'device' => $device,
            'comment' => $comment,
            'createdAT' => 1,
            "form" => $form->createView()
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
     */
    public function deviceList(Request $request)
    {
        $stmt= $this->getDoctrine()
            ->getRepository(Device::class)->findAllPhone();
//        dd($stmt[1]['phone']);
            for($n=0; $n < count($stmt);$n++)
            {
                $maker[$stmt[$n]['phone']]=$stmt[$n]['phone'];
            }
//        dd($x);
        $defaultData = ['message' => 'your message here'];
        $form = $this->createFormBuilder($defaultData)
            ->add('Phone', ChoiceType::class,['choices' => [$maker],
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
            [
                "devices" => $devices,
                "form" => $form->createView()
            ]
        );
    }


    /**
     * @Route("/comment/create/{id}", requirements={"id"="\d+"}, name="create_comment")
     * @param Device $device
     * @return Response
     * @throws \Exception
     */
    public function createComment(Device $device)
    {
        $created_ad= new \DateTime();
        $message= new CommentMessage();
        $message->setItemId($device); // вставить item_id
        $message->setCreatedAt($created_ad);
        $message->setMessage("hello World This IS DEVICE");
        $message->setAuthor($this->getUser()->getEmail());

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($message);
        $manager->flush();

        return new Response("Создан новое сообщение с id: ");

    }
//, methods={"GET"})
    /**
     * @Route("/buy", name="buy_device")
     * @param Device $device
     * @return Response
     */
    public function buyDevice()
    {
        $arr = ["status" => "success"];
        dd($arr);
        return $this->json($arr);
    }


    /**
     * @Route("/raul/{num}", requirements={"num"="\d+"}, name="raul_resp")
     * @param $num
     * @return Response
     */
    public function respRaul($num)
    {
        $arr = ["hello Raul", $num];
        return $this->json($arr);//new Response("Создан новое сообщение с id: ");
    }


}
