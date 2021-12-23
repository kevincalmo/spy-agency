<?php

namespace App\Controller;

use App\Entity\Speciality;
use App\Form\SpecialityType;
use App\Repository\SpecialityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class SpecialityController extends AbstractController
{
    /**
     * @Route("/speciality", name="speciality")
     */
    public function index(SpecialityRepository $specialityRepository): Response
    {
        $specialitys = $specialityRepository->findAll();

        return $this->render('speciality/index.html.twig', [
            'items'=>$specialitys,
            'type'=>'speciality',
        ]);
    }

     /**
     * @Route("/add-speciality" , name="add-speciality")
     */
    public function addAgent(Request $request): Response
    {
        $speciality = new Speciality;
        $form = $this->createForm(SpecialityType::class,$speciality);
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $entityManager = $this->getdoctrine()->getManager();
                $entityManager->persist($speciality);
                $entityManager->flush();
            }

            
        
        
        return $this->render('form-item.html.twig', [
           'form'=>$form->createView(),
           'type'=>'speciality',
           'function'=>'Creer'
        ]);
    }

    /**
     * @Route("/edit-speciality/{id}" , name="edit-speciality")
     */
    public function editSpeciality($id ,Request $request, SpecialityRepository $specialityRepository): Response
    {
        $speciality = $specialityRepository->find($id);
        $form = $this->createForm(SpecialityType::class,$speciality);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getdoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute("speciality");
        }

            
        return $this->render('form-item.html.twig', [
           'form'=>$form->createView(),
           'type'=>'speciality',
           'function'=>'Editer'
        ]);
    }

}
