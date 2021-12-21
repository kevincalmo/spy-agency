<?php

namespace App\Controller;
use App\Entity\Agents;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @Route("/admin")
 */
class AgentsController extends AbstractController
{
    /**
     * @Route("/agents", name="agents")
     * 
     */
    public function index(): Response
    {
        
        $agent = (new Agents())
            ->setLastName('Doe')
            ->setFirstName('John')
            ->setAuthentificationCode('y9FFmmJ35')
            ->setNationality('France')
            ->setPassword('ih46K7MDc');
    
        return $this->render('agents/index.html.twig', [
            'agent' => $agent,
        ]);
    }
}
