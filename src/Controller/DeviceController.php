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
        $device->setPrice(9999);
        $device->setModel('A5');
        $device->setDisplay(5.5);
        $device->setProducer("China");

        $entityManager->persist($device);
        $entityManager->flush();
        return new Response('Создано новое устройство с ID = '.$device->getId());
    }

}
