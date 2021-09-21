<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish-list", name="wish-list")
     */
    public function wichList(WishRepository $repo): Response
    {
        $wishList = $repo->findAll();


        return $this->render('wish/list.html.twig', [
            'wishList' => $wishList
        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(Wish $wish): Response
    {
        // dd($wish);
        return $this->render('wish/details.html.twig', [
            'wish' => $wish
        ]);
    }
}
