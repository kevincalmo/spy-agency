<?php

namespace App\Controller;
use App\Entity\Agents;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Form\AgentsType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class AgentsController extends AbstractController
{
    /**
     * @Route("/agents", name="agents")
     * 
     */
    public function index(Request $request): Response
    {
        
    
        return $this->render('agents/index.html.twig', [
           
        ]);
    }

    public function addAgent(Request $request)
    {
        $agent = new Agents;
        $form = $this->createForm(AgentsType::class,$agent);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            dd($agent);
        }
    
        return $this->render('agents/index.html.twig', [
           'form'=>$form->createView(),
        ]);
    }
}
