<?php

namespace App\Controller;

use App\Entity\Agents;
use App\Entity\Contacts;
use App\Entity\Stashs;
use App\Entity\Targets;
use App\Repository\AgentsRepository;
use App\Repository\ContactsRepository;
use App\Repository\MissionsRepository;
use App\Repository\StashsRepository;
use App\Repository\TargetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/home", name="admin")
     */
    public function index(AgentsRepository $agentsRepository, 
                          MissionsRepository $missionsRepository,
                          ContactsRepository $contactsRepository,
                          StashsRepository $stashsRepository,
                          TargetsRepository $targetsRepository): Response
    {
        $agents = $agentsRepository->findAll();
        $missions = $missionsRepository->findAll();
        $contacts = $contactsRepository->findAll();
        $stashs = $stashsRepository->findAll();
        $targets = $targetsRepository->findAll();

        dump($missions);

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'agents'=>$agents,
            'missions'=>$missions,
            'contacts'=>$contacts,
            'stashs'=>$stashs,
            'targets'=>$targets,
        ]);
    }
}
