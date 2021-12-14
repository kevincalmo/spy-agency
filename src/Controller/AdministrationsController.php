<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministrationsController extends AbstractController
{
    /**
     * @Route("/administrations", name="administrations")
     */
    public function index(): Response
    {
        return $this->render('administrations/index.html.twig', [
            'controller_name' => 'AdministrationsController',
        ]);
    }
}
