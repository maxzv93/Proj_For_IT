<?php

namespace App\Controller;

use App\Entity\Device;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/device/create", name="create_device")
     */
    public function createDevice()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $device = new Device();
        $device->setPhone('Samsung');
        $device->setPrice(19999);
        $device->setModel('A6');
        $device->setDisplay(5.9);
        $device->setProducer("China");

        $entityManager->persist($device);
        $entityManager->flush();
        return new Response('Создано новое устройство с ID = '.$device->getId());
    }

    /**
     * @Route("/device/{id}", name="device_show")
     */
    public function show($id)
    {
        $device = $this->getDoctrine()
            ->getRepository(Device::class)
            ->find($id);

        if (!$device) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $phone = $device->getPhone();
        $model = $device->getModel();
        $producer = $device->getProducer();
        $price = $device->getPrice();
        $display = $device->getDisplay();
        $memory_size = $device->getMemorySize();

        //return new Response('Информация о продукте '.$device->getModel());

        // or render a template
        // in the template, print things with {{ product.name }}
         return $this->render('device/show.html.twig', [
             'phone' => $phone,
             'model' => $model,
             'display' => $display,
             'price' => $price,
             'memory_size' => $memory_size,
             'producer' => $producer
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
                'No device found for id '.$id
            );
        }

        $device->setPhone('SaMsUNG');
        $entityManager->flush();

        return $this->redirectToRoute('device_show', [
            'id' => $device->getId()
        ]);
    }


}
