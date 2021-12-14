<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionsController extends AbstractController
{
    /**
     * @Route("/missions", name="missions")
     */
    public function index(): Response
    {
        return $this->render('missions/index.html.twig', [
            'controller_name' => 'MissionsController',
        ]);
    }
}
