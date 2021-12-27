<?php

namespace App\Controller;

use App\Entity\Missions;
use App\Form\MissionsType;
use App\Repository\AgentsRepository;
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
            'items' => $missions,
            'type' => 'missions'
        ]);
    }

    /**
     * @Route("/add-mission" , name="add-mission")
     */
    public function addMission(Request $request, AgentsRepository $agentsRepository): Response
    {
        $mission = new Missions;
        $form = $this->createForm(MissionsType::class, $mission);
        $form->handleRequest($request);
        $errorsForm = [];

        if ($form->isSubmitted() && $form->isValid()) {
            //Vérification des spécificités de mission


            /* dd($mission->getAgents()); */
            /**
             * initialisation du tableau d'eerues du formulaire
             * @var array
             */
            


            $countryMissionForm = $mission->getCountry();
            $specialityMissionForm = $mission->getSpecialitys();



            $countryAgentsForm = [];
            foreach ($mission->getAgents() as $agent) {
                $countryAgentsForm[] = $agent->getNationality();
            }

            $specialityAgentsForm = [];

            $countryContactsForm = [];
            foreach ($mission->getContacts() as $contact) {
                
                if($contact->getNationality() !== $countryMissionForm){
                    $errorsForm[]= "Les contacts présents sur la mission doivent avoir la nationalité du lieu de la mission";
                }
            }

            $countryTargetsForm = [];
            foreach ($mission->getTargets() as $target) {
                $countryTargetsForm[] = $target->getNationality();
            }

            $countryStashsForm = [];
            foreach ($mission->getStashs() as $stash) {
                if($stash->getCountry() !== $countryMissionForm){
                    $errorsForm[]= "Les planques présents sur la mission doivent avoir la nationalité du lieu de la mission";
                }
            }

            /*================ Vérification au niveau des agents ================*/
            $i=0;
            $n = 1;
            foreach ($mission->getAgents() as $agent) {

                
                $agent = $agentsRepository->find($agent->getId());
                foreach($agent->getSpecialitys() as $speciality){
                    
                    foreach($specialityMissionForm as $missionSpeciality){
                        if($speciality === $missionSpeciality) $i++;
                    }
                }

                

                foreach($mission->getTargets() as $target){
                    if($agent->getNationality() === $target->getNationality()){
                        $errorsForm[]= "Les agents et les cibles ne peuvent avoir les même nationalités";
                    }
                }


            }

            if($i === 0) $errorsForm[]= "Aucun agent sélectionné ne possède la spécialité requise pour cette mission";

            dump($specialityMissionForm);

            if (empty($errorsForm)) {
                /* $entityManager = $this->getdoctrine()->getManager();
                                $entityManager->persist($mission);
                                $entityManager->flush(); */
                
            }
        }




        return $this->render('form-item.html.twig', [
            'form' => $form->createView(),
            'type' => 'mission',
            'function' => 'Creer',
            'errorsValidation'=>$errorsForm,
        ]);
    }

    /**
     * @Route("/edit-mission/{id}" , name="edit-mission")
     */
    public function editAgent($id, Request $request, MissionsRepository $missionsRepository): Response
    {
        $mission = $missionsRepository->find($id);
        $form = $this->createForm(MissionsType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getdoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute("missions");
        }


        return $this->render('form-item.html.twig', [
            'form' => $form->createView(),
            'type' => 'mission',
            'function' => 'Editer'
        ]);
    }
}
