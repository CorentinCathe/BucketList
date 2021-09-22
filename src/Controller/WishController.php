<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/details/remove/{id}", name="remove")
     */
    public function remove(Wish $wish, EntityManagerInterface $em): Response
    {
        $em->remove($wish);
        $em->flush();
        return $this->redirectToRoute('wish-list');
    }

    /**
     * @Route("wish_add", name="add")
     */
    public function add(Request $req): Response
    {
        $wish = new Wish();

        $formWish = $this->createForm(WishType::class, $wish);

        $formWish->handleRequest($req);
        if ($formWish->isSubmitted()) {
            $wish->setIsPublished(true);
            $wish->setDateCreated(new DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($wish);
            $em->flush();

            return $this->redirectToRoute('wish-list');
        }

        return $this->render('wish/addWish.html.twig', [
            'formWish' => $formWish->createView()
        ]);
    }
}
