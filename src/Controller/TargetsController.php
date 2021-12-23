<?php

namespace App\Controller;

use App\Entity\Targets;
use App\Form\TargetsType;
use App\Repository\TargetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class TargetsController extends AbstractController
{
    /**
     * @Route("/targets", name="targets")
     */
    public function index(TargetsRepository $targetsRepository): Response
    {

        $targets = $targetsRepository->findAll();
        return $this->render('targets/index.html.twig', [
            'items'=>$targets,
            'type'=>'targets',
        ]);
    }

     /**
     * @Route("/add-target" , name="add-target")
     */
    public function addAgent(Request $request): Response
    {
        $target = new Targets;
        $form = $this->createForm(TargetsType::class,$target);
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $entityManager = $this->getdoctrine()->getManager();
                $entityManager->persist($target);
                $entityManager->flush();
            }

            
        
        
        return $this->render('form-item.html.twig', [
           'form'=>$form->createView(),
           'type'=>'target',
           'function'=>'Creer'
        ]);
    }

    /**
     * @Route("/edit-target/{id}" , name="edit-target")
     */
    public function editTarget($id ,Request $request, TargetsRepository $targetsRepository): Response
    {
        $target = $targetsRepository->find($id);
        $form = $this->createForm(TargetsType::class,$target);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getdoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute("targets");
        }

            
        return $this->render('form-item.html.twig', [
           'form'=>$form->createView(),
           'type'=>'target',
           'function'=>'Editer'
        ]);
    }
}
