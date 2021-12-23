<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\ContactsType;
use App\Repository\ContactsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/admin")
 */
class ContactsController extends AbstractController
{
    /**
     * @Route("/contacts", name="contacts")
     */
    public function index(ContactsRepository $contactsRepository): Response
    {

        $contacts = $contactsRepository->findAll();

        return $this->render('contacts/index.html.twig', [
            'controller_name' => 'ContactsController',
            'items' => $contacts,
        ]);
    }

    /**
     * @Route("/add-contact" , name="add-contact")
     */
    public function addContact(Request $request,
                             ValidatorInterface $validatorInterface): Response
    {
        $contact = new Contacts;
        $form = $this->createForm(ContactsType::class,$contact);
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $entityManager = $this->getdoctrine()->getManager();
                $entityManager->persist($contact);
                $entityManager->flush();
            }

            
        
        
        return $this->render('form-item.html.twig', [
           'form'=>$form->createView(),
           'type'=>'contact',
           'function'=>'Creer'
        ]);
    }

    /**
     * @Route("/edit-contact/{id}" , name="edit-contact")
     */
    public function editContact($id ,
                             Request $request,
                             ContactsRepository $contactsRepository): Response
    {
        $contact = $contactsRepository->find($id);
        $form = $this->createForm(ContactsType::class,$contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getdoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute("contacts");
        }

            
        
        
        return $this->render('form-item.html.twig', [
           'form'=>$form->createView(),
           'type'=>'contact',
           'function'=>'Editer'
        ]);
    }
}
