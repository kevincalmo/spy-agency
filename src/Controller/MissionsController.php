<?php

namespace App\Controller;

use App\Entity\Missions;
use App\Form\MissionsType;
use App\Repository\MissionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class MissionsController extends AbstractController
{
    /**
     * @Route("/missions", name="missions")
     */
    public function index(MissionsRepository $missionsRepository): Response
    {

        $missions = $missionsRepository->findAll();

        return $this->render('missions/index.html.twig', [
            'items'=>$missions,
            'type'=>'missions'
        ]);
    }

     /**
     * @Route("/add-mission" , name="add-mission")
     */
    public function addMission(Request $request): Response
    {
        $mission = new Missions;
        $form = $this->createForm(MissionsType::class,$mission);
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $entityManager = $this->getdoctrine()->getManager();
                $entityManager->persist($mission);
                $entityManager->flush();
            }

            
        
        
        return $this->render('form-item.html.twig', [
           'form'=>$form->createView(),
           'type'=>'mission',
           'function'=>'Creer'
        ]);
    }

    /**
     * @Route("/edit-mission/{id}" , name="edit-mission")
     */
    public function editAgent($id ,Request $request, MissionsRepository $missionsRepository): Response
    {
        $mission = $missionsRepository->find($id);
        $form = $this->createForm(MissionsType::class,$mission);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getdoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute("missions");
        }

            
        return $this->render('form-item.html.twig', [
           'form'=>$form->createView(),
           'type'=>'mission',
           'function'=>'Editer'
        ]);
    }
}
