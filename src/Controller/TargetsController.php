<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TargetsController extends AbstractController
{
    /**
     * @Route("/targets", name="targets")
     */
    public function index(): Response
    {
        return $this->render('targets/index.html.twig', [
            'controller_name' => 'TargetsController',
        ]);
    }
}
