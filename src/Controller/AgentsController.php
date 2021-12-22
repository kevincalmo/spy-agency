<?php

namespace App\Controller;
use App\Entity\Agents;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Form\AgentsType;
use App\Repository\AgentsRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * @Route("/admin")
 */
class AgentsController extends AbstractController
{
    /**
     * @Route("/agents", name="agents")
     * 
     */
    public function index(AgentsRepository $agentsRepository): Response
    {
        $agents = $agentsRepository->findAll();
    
        return $this->render('agents/index.html.twig', [
           'agents'=> $agents,
        ]);
    }

    /**
     * @Route("/add-agent" , name="add-agent")
     */
    public function addAgent(Request $request,
                             ValidatorInterface $validatorInterface,
                             UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $agent = new Agents;
        $form = $this->createForm(AgentsType::class,$agent);
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $entityManager = $this->getdoctrine()->getManager();
                $entityManager->persist($agent);
                $entityManager->flush();
            }

            
        
        
        return $this->render('agents/add-agent.html.twig', [
           'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/edit-agent/{id}" , name="edit-agent")
     */
    public function editAgent($id ,
                             Request $request,
                             UserPasswordEncoderInterface $passwordEncoder,
                             AgentsRepository $agentsRepository): Response
    {
        $agent = $agentsRepository->find($id);
        $form = $this->createForm(AgentsType::class,$agent);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getdoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute("agents");
        }

            
        
        
        return $this->render('agents/edit-agent.html.twig', [
           'form'=>$form->createView(),
        ]);
    }


}
