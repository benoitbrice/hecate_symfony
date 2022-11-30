<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Entity\School;
use App\Repository\ClassroomRepository;
use App\Repository\SchoolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    private int $maValeur;

    public function __construct()
    {
        $this->maValeur = 10;
    }

    #[Route('/test/{id}', name: 'app_test')]
    public function index($id, SchoolRepository $schoolRepository, ClassroomRepository $classroomRepository): Response
    {
        //$listSchool = $schoolRepository->findAll();
        //$oneSchool = $schoolRepository->findByCity('Paris');
        //$listSchoolByAddress = $schoolRepository->findByAddress('2');

        //INSERT D UNE ECOLE
      /*$newSchool = new School();
      $newSchool->setName('lsdkfjgldfskhgdfkjl');
      $newSchool->setAddress('2 allée du muguet');
      $newSchool->setPostalCode('60290');
      $newSchool->setCity('Neuilly-sous-Clermont');

      $schoolRepository->save($newSchool, true);

        $classroom = new Classroom();
        $classroom->setName('Black pearl');
        $classroom->setCapacity(20);
        $classroom->setSchool($newSchool);

        $classroomRepository->save($classroom, true);*/


        //UPDATE D UNE ECOLE
//        $laPasserelle = $schoolRepository->findOneById(1);
//        $laPasserelle->setAddress('2 rue du chaudron');
//        $laPasserelle->setPostalCode('75010');
//        $laPasserelle->setCity('Paris');

//        $schoolRepository->save($laPasserelle, true);

/*        $maClassroom = $classroomRepository->findOneById(1);
        $maSchool = $schoolRepository->findOneById(1);

        $maClassroom->setSchool($maSchool);
        $classroomRepository->save($maClassroom, true);

        dd($maClassroom);
        */




//        dd($laPasserelle);

        //DELETE D UNE ECOLE
//        $schoolToRemove = $schoolRepository->findOneById(4);
//        $schoolRepository->remove($schoolToRemove, true);*/

       /* $maSchool = $schoolRepository->findOneById(3);
        $schoolRepository->remove($maSchool, true);
        */

        //RECHERCHE D UNE ECOLE PAR RAPPORT A SON NOM
        //$search = $schoolRepository->getSchoolBySearchName('sch');

        //dd($search);

        $listSchoolByAddress = $schoolRepository->getSchoolByAddress('rue');
        dd($listSchoolByAddress);



        return $this->render('test/index.html.twig', [
            'controller_name' => 'PAGE 1',
            'valeurPage' => $this->maValeur
        ]);
    }

    #[Route('/test_2', name: 'app_test_2')]
    public function page2(): Response
    {
        return $this->render('test/page2.html.twig', [
            'controller_name' => 'PAGE 2',
            'valeurPage' => $this->maValeur
        ]);
    }

    #[Route('/dernierepagedelappplication', name: 'app_test_3')]
    public function page3(): Response
    {
        return $this->render('test/page3.html.twig', [
            'controller_name' => 'PAGE 3',
            'valeurPage' => $this->maValeur
        ]);
    }

}
