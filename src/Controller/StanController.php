<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Modele;
use App\Entity\Uzytkownicy;
use App\Entity\Sprzet;


class StanController extends AbstractController
{
    #[Route('/stan', name: 'app_stan')]
    public function stan(EntityManagerInterface $entityManager, Request $request, SessionInterface $session): Response
    {   
        if($request->isMethod('POST'))
        {
            $postData = $request->request->all();
            $selectedModelsIds = $postData['selectedModels'] ?? [];

            foreach ($selectedModelsIds as $modelId) {
                $model = $entityManager->getRepository(Modele::class)->find($modelId);
                $entityManager->remove($model);
            }
            $entityManager->flush();
        }

        $modele = $entityManager->getRepository(Modele::class)->findAll();

        return $this->render('stan.html.twig', [
            'modele' => $modele
        ]);
    }



    #[Route('/model/{model_id}', name: 'app_model')]
    public function model(int $model_id, Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $chosenModel = $entityManager->getRepository(Modele::class)->find($model_id);

        $deviceType = $chosenModel->getTyp();

        $template = 'modelAkcesoria.html.twig';
        if ($deviceType === 'laptop' || $deviceType === 'komputer stacjonarny') {
            $template = 'modelPC.html.twig';
        }

        return $this->render($template, [
            'chosenModel' => $chosenModel
        ]);
    }



    #[Route('/editModel/{model_id}', name: 'app_editModel')]
    public function editModel(int $model_id, Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $chosenModel = $entityManager->getRepository(Modele::class)->find($model_id);

        if ($request->isMethod('POST')) 
        {
            $chosenModel->setTyp($request->request->get('typ'));
            $chosenModel->setNazwa($request->request->get('nazwa'));
            $chosenModel->setProducent($request->request->get('producent'));
            $chosenModel->setSystemOperacyjny($request->request->get('systemOperacyjny'));
            $chosenModel->setCpu($request->request->get('cpu'));
            $chosenModel->setRam($request->request->get('ram'));
            $chosenModel->setDysk($request->request->get('dysk'));
            $chosenModel->setPrzeznaczenie($request->request->get('przeznaczenie'));
            $chosenModel->setIloscOgolna($request->request->get('iloscOgolna'));

            $entityManager->persist($chosenModel);
            $entityManager->flush();

            $session->getFlashBag()->add('success', 'Model został zmodyfikowany pomyślnie.');
        }
    
        return $this->render('editModel.html.twig', [
            'chosenModel' => $chosenModel
        ]);
    }


    #[Route('/addModel', name: 'app_addModel')]
    public function addModel(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        if ($request->isMethod('POST')) 
        {
            $model = new Modele();

            $model->setTyp($request->request->get('typ'));
            $model->setNazwa($request->request->get('nazwa'));
            $model->setProducent($request->request->get('producent'));
            $model->setSystemOperacyjny($request->request->get('systemOperacyjny'));
            $model->setCpu($request->request->get('cpu'));
            $model->setRam($request->request->get('ram'));
            $model->setDysk($request->request->get('dysk'));
            $model->setPrzeznaczenie($request->request->get('przeznaczenie'));
            $model->setIloscOgolna($request->request->get('iloscOgolna'));

            $entityManager->persist($model);
            $entityManager->flush();

            $session->getFlashBag()->add('success', 'Nowy model został dodany pomyślnie.');
        }
    
        return $this->render('addModel.html.twig', []);
    }



    #[Route('/assignModel/{model_id}', name: 'app_assignModel')]
    public function assignModel(int $model_id, Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $chosenModel = $entityManager->getRepository(Modele::class)->find($model_id);
        $sprzety = $entityManager->getRepository(Sprzet::class)->findBy(['id_modelu' => $model_id]);
        $users = $entityManager->getRepository(Uzytkownicy::class)->findAll();

        if ($request->isMethod('POST')) 
        {
            $selectedSprzetId = $request->request->get('sprzet');
            $selectedUserId = $request->request->get('uzytkownik');
            $selectedDate = $request->request->get('data-wydania');

            $selectedSprzet = $entityManager->getRepository(Sprzet::class)->find($selectedSprzetId);
            $selectedUser = $entityManager->getRepository(Uzytkownicy::class)->find($selectedUserId);

            $imie_nazwisko = $selectedUser->getImieNazwisko();
            $lokalizacja = $selectedUser->getLokalizacja();
            $stanowisko = $selectedUser->getStanowisko();
            $tel = $selectedUser->getTel();

            $selectedSprzet->setIdUzytkownika($selectedUserId);
            $selectedSprzet->setPrzypisanyUzytkownik($imie_nazwisko);
            $selectedSprzet->setLokalizacja($lokalizacja);
            $selectedSprzet->setStanowisko($stanowisko);
            $selectedSprzet->setNrTel(str_replace(" ", "", $tel));
            $selectedSprzet->setDataWydania($selectedDate);


            $entityManager->persist($selectedSprzet);
            $entityManager->flush();
        }

        return $this->render('assignModel.html.twig', [
            'chosenModel' => $chosenModel,
            'users' => $users,
            'sprzety' => $sprzety
        ]);
    }
}