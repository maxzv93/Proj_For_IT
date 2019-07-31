<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RandomController extends AbstractController
{
    /**
     * @Route("/random", name="random")
     */
    public function index()
    {
        return $this->render('random/index.html.twig', [
            'controller_name' => 'RandomController',
        ]);
    }

    /**
     * @Route("/random/number", name="random")
     */
    public function RandomGen()
    {
        $number = random_int(10, 100);
        return $this->render('random/randomnum.html.twig', [
            'number' => $number,
       ]);
    }
}
