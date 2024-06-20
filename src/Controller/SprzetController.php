<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Sprzet;
use App\Entity\Uzytkownicy;


class SprzetController extends AbstractController
{


    #[Route('/sprzet', name: 'app_sprzet')]
    public function sprzet(EntityManagerInterface $entityManager, Request $request, SessionInterface $session): Response
    {

        $sprzet = $entityManager->getRepository(Sprzet::class)->findAll();
        $users = $entityManager->getRepository(Uzytkownicy::class)->findAll();

        if ($request->isMethod('POST')) 
        {
            $all = $request->request->all();
            $selectedSprzetIds = $all['selectedSprzet'] ?? [];

            foreach ($selectedSprzetIds as $sprzetId) {
                $sprzet = $entityManager->getRepository(Sprzet::class)->find($sprzetId);
                $entityManager->remove($sprzet);
            }
            $entityManager->flush();
        }

        return $this->render('sprzet.html.twig', [
            'sprzety' => $sprzet,
            'users' => $users,
        ]);
    }

    #[Route('/assignSprzet/{sprzet_id}', name: 'app_assignSprzet')]
    public function assignSprzet(int $sprzet_id, Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $selectedSprzetIds = $session->get('selectedSprzet');

        if (!empty($selectedSprzetIds)) 
        {
            $choosenSprzet = [];

            foreach ($selectedSprzetIds as $sprzetId) {
                $choosenSprzet[] = $entityManager->getRepository(Sprzet::class)->find($sprzetId);
            }
    
            $session->remove('selectedSprzet');
        }
    
        return $this->render('assignSprzet.html.twig');
    }
    

    #[Route('/sprzet/{sprzet_id}', name: 'app_getSprzet')]
    public function getSprzet(int $sprzet_id, EntityManagerInterface $entityManager): Response
    {

        $chosenSprzet = $entityManager->getRepository(Sprzet::class)->find($sprzet_id);

        return $this->render('chooseSprzet.html.twig', [
            'chosenSprzet' => $chosenSprzet
        ]);
    }



    #[Route('/addSprzet', name: 'app_addSprzet')]
    public function addSprzet(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {

        if ($request->isMethod('POST')) 
        {
            $sprzet = new Sprzet();

            $sprzet->setTyp($request->request->get('typ'));
            $sprzet->setProducent($request->request->get('producent'));
            $sprzet->setHostname($request->request->get('nazwa'));
            $sprzet->setNazwa($request->request->get('model'));
            $sprzet->setIdModelu($request->request->get('idModelu'));
            $sprzet->setCpu($request->request->get('cpu'));
            $sprzet->setRam($request->request->get('ram'));
            $sprzet->setDysk($request->request->get('dysk'));
            $sprzet->setSystemOperacyjny($request->request->get('systemOperacyjny'));
            $sprzet->setDataZakupu($request->request->get('dataZakupu'));
            $sprzet->setPrzeznaczenie($request->request->get('przeznaczenie'));
    
            $entityManager->persist($sprzet);
            $entityManager->flush();

            $session->getFlashBag()->add('success', 'Nowy sprzęt został dodany pomyślnie.');
        }

        return $this->render('addSprzet.html.twig', []);
    }




    #[Route('/editSprzet/{sprzet_id}', name: 'app_editSprzet')]
    public function editSprzet(int $sprzet_id, Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {

        $chosenSprzet = $entityManager->getRepository(Sprzet::class)->find($sprzet_id);

        if ($request->isMethod('POST')) 
        {

            $chosenSprzet->setProducent($request->request->get('producent'));
            $chosenSprzet->setSystemOperacyjny($request->request->get('systemOperacyjny'));
            $chosenSprzet->setCpu($request->request->get('cpu'));
            $chosenSprzet->setRam($request->request->get('ram'));
            $chosenSprzet->setDysk($request->request->get('dysk'));
            $chosenSprzet->setPrzeznaczenie($request->request->get('przeznaczenie'));

            $entityManager->persist($chosenSprzet);
            $entityManager->flush();

            $session->getFlashBag()->add('success', 'Sprzęt został pomyślnie zmodyfikowany.');
        }

        return $this->render('editSprzet.html.twig', [
            'chosenSprzet' => $chosenSprzet
        ]);
    }

}
