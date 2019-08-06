<?php

namespace App\Controller;

use App\Entity\Device;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class BasketController extends AbstractController
{
//    /**
//     * @Route("/basket", name="basket")
//     */
//    public function index()
//    {
//        return $this->render('basket/index.html.twig', [
//            'controller_name' => 'BasketController',
//        ]);
//    }



/**
 * @Route("/basket", name="device_basket")
 * @param User $user
 * @return Response
 */
public function basket()//User $user, Device $device)
{
   $id = $this->getUser()->getId();

    $data = $this->getDoctrine()
        ->getRepository(Device::class)
        ->findAllItemsUser($id);
//    dd($data);

    return $this->render(
        'basket/basket.html.twig'
        ,
        ["devices" => $data]
    );
}

    /**
     * @Route("/setFavour/{id}", requirements={"id"="\d+"}, name="device_set_favourite")
     * @param Device $device
     * @return Response
     */
public function setToFavourite(Device $device)//User $user, Device $device)
{

    $id = $this->getUser()->getId();
    $itemid = $device->getId();
    $data = $this->getDoctrine()
        ->getRepository(Device::class)
        ->setAllItemsUser($id,$itemid);
//    dd($data);

    return $this->render(
        'basket/basket.html.twig'
        ,
        ["devices" => $data]
    );
}


    /**
     * @Route("/deleteFromBasket/{id}", requirements={"id"="\d+"}, name="device_delete_favourite")
     * @param Device $device
     * @return Response
     */
    public function deleteToFavourite(Device $device)//User $user, Device $device)
    {

        $id = $this->getUser()->getId();
        $itemid = $device->getId();
        $data = $this->getDoctrine()
            ->getRepository(Device::class)
            ->deleteItemsUser($id,$itemid);


        return $this->render(
            'basket/basket.html.twig'
            ,
            ["devices" => $data]
        );
    }

}
//
//        $query = $entityManager->createQuery(
//            'SELECT p
//                FROM App\Entity\Device p INNER JOIN App\Entity\Device_user
//
//                ')->setParameters(['Phone' => $Phone, 'MinPrice' => $MinPrice, 'MaxPrice' => $MaxPrice,
//            'MaxVol' => $MaxVol, 'MinVol' => $MinVol]);
//                WHERE p.Phone = :Phone
//                AND p.Price >= :MinPrice
//                AND p.Price <= :MaxPrice
//                AND p.MemorySize >= :MinVol
//                AND p.MemorySize <= :MaxVol'



    // returns an array of Product objects
//    return $query->execute();




//    $form = $this->createFormBuilder($device)
//        ->add('Phone', TextType::class,[
//            'required' => false,
//            'label' => 'Производитель'])
//        ->add('MinVol', IntegerType::class,[
//            'required' => false,
//            'label' => 'Минимальный объем памяти'])
//        ->add('MaxVol', IntegerType::class,[
//            'required' => false,
//            'label' => 'Максимальный объем памяти'])
//        ->add('MinPrice', IntegerType::class,[
//            'required' => false,
//            'label' => 'Минимальная цена'])
//        ->add('MaxPrice', IntegerType::class,[
//            'required' => false,
//            'label' => 'Максимальная цена'])
//        ->add('send', SubmitType::class,['label' => 'Поиск'])
//        ->getForm();

//        $form->handleRequest($request);
//    $data = $form->getData();

//    if ($form->isSubmitted() && $form->isValid() &&
//        (($data['Phone']!="") || ($data['MinPrice']!="") || ($data['MaxPrice']!="")
//    || ($data['MinVol']!="") || ($data['MaxVol']!=""))
//    )
//


