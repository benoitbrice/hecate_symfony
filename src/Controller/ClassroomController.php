<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(ClassroomRepository $classroomRepository): Response
    {
        $listClassroom = $classroomRepository->findAll();

        return $this->render('classroom/index.html.twig', [
            'listClassroom' => $listClassroom
        ]);
    }

    #[Route('/classroomadd', name: 'app_classroom_add')]
    public function add(ClassroomRepository $classroomRepository, Request $request): Response
    {
        $classroom = new Classroom();

        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $classroomRepository->save($classroom, true);

            return $this->redirectToRoute('app_classroom');

        }
        
        return $this->render('classroom/add.html.twig', [
            'formAdd' => $form->createView()
        ]);
    }
}
