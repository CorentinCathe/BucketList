<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish-list", name="wish-list")
     */
    public function wichList(): Response
    {
        return $this->render('wish/list.html.twig');
    }

    /**
     * @Route("/details", name="details")
     */
    public function details(): Response
    {
        return $this->render('wish/details.html.twig', [
            'controller_name' => 'WishController',
        ]);
    }
}
