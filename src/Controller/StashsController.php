<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StashsController extends AbstractController
{
    /**
     * @Route("/stashs", name="stashs")
     */
    public function index(): Response
    {
        return $this->render('stashs/index.html.twig', [
            'controller_name' => 'StashsController',
        ]);
    }
}
