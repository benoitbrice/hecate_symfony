<?php

namespace App\Controller;

use App\Entity\School;
use App\Form\SchoolType;
use App\Repository\SchoolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SchoolController extends AbstractController
{
    #[Route('/school', name: 'app_school')]
    public function index(SchoolRepository $schoolRepository): Response
    {
        //je recupere toutes les ecoles
        $listSchool = $schoolRepository->findAll();

        //j'appel la vue en passant les ecole en parametres
        return $this->render('school/index.html.twig', [
            'controller_name' => 'SchoolController',
            'listSchool' => $listSchool
        ]);
    }

    #[Route('/school/{id}', name: 'app_school_details')]
    public function details($id, SchoolRepository $schoolRepository): Response
    {
        //je recuperer une ecole dans la BDD par son id
        $school = $schoolRepository->findOneById($id);

        //j'appel la vue en passant l'ecole en parametre
        return $this->render('school/details.html.twig', [
            'school' => $school
        ]);
    }

    #[Route('/schooladd', name: 'app_school_add')]
    public function add(Request $request, SchoolRepository $schoolRepository): Response
    {
        //j'initilise un objet vide
        $school = new School();

        //j'appel l'objet formulaire et je lui donne l'objet dont il découle
        $form = $this->createForm(SchoolType::class, $school);
        //le handlerequest permet de faire les verification du formulaire
        //et si il est valide de remplir l'objet $school avec les informations du formulaire
        $form->handleRequest($request);

        //condition qui se déclenche suelement si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            //sauvegarde en bdd de l'ecole
            $schoolRepository->save($school, true);

            //redirection vers la page d'accueil
            return $this->redirectToRoute('app_school');
        }

        //j'appel la vue en passant l'ecole en parametre
        return $this->render('school/add.html.twig', [
            'formAdd' => $form->createView()
        ]);
    }

    #[Route('/schooledit/{id}', name: 'app_school_edit')]
    public function edit($id, Request $request, SchoolRepository $schoolRepository): Response
    {
        //je récupère l'ecole dans la bdd grace a son ID
        $school = $schoolRepository->findOneById($id);

        //j'appel l'objet formulaire et je lui donne l'objet dont il découle
        $form = $this->createForm(SchoolType::class, $school);
        //le handlerequest permet de faire les verification du formulaire
        //et si il est valide de remplir l'objet $school avec les informations du formulaire
        $form->handleRequest($request);

        //condition qui se déclenche suelement si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            //sauvegarde en bdd de l'ecole
            $schoolRepository->save($school, true);

            //redirection vers la page d'accueil
            return $this->redirectToRoute('app_school');
        }

        //j'appel la vue en passant l'ecole en parametre
        return $this->render('school/edit.html.twig', [
            'school' => $school,
            'formEdit' => $form->createView()
        ]);
    }

    #[Route('/schoolremove/{id}', name: 'app_school_remove')]
    public function remove($id, Request $request, SchoolRepository $schoolRepository): Response
    {
        //je récupère l'ecole dans la bdd grace a son ID
        $school = $schoolRepository->findOneById($id);
        //je lanse la suppression en ajoutant le true en deuxieme parametre afin qu'il soit execute tout de suite
        $schoolRepository->remove($school, true);

        //redirection vers la page d'accueil
        return $this->redirectToRoute('app_school');
    }
}
