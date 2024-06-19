<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Uzytkownicy;

class UsersController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function users(EntityManagerInterface $entityManager, Request $request): Response
    {

        if ($request->isMethod('POST')) 
        {
            $postData = $request->request->all();
            $selectedUserIds = $postData['selectedUsers'] ?? [];

            foreach ($selectedUserIds as $userId) {
                $user = $entityManager->getRepository(Uzytkownicy::class)->find($userId);
                $entityManager->remove($user);
            }
            $entityManager->flush();
        }

        $users = $entityManager->getRepository(Uzytkownicy::class)->findAll();

        return $this->render('users.html.twig', [
            'users' => $users,
        ]);
    }
    
    #[Route('/addUser', name: 'app_addUser')]
    public function addUser(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {

        if ($request->isMethod('POST')) 
        {
            $user = new Uzytkownicy();

            $user->setImieNazwisko($request->request->get('imieNazwisko'));
            $user->setLokalizacja($request->request->get('lokalizacja'));
            $user->setStanowisko($request->request->get('stanowisko'));
            $user->setTel($request->request->get('telefon'));
    
            $entityManager->persist($user);
            $entityManager->flush();

            $session->getFlashBag()->add('success', 'Nowy użytkownik został dodany pomyślnie.');
        }

        return $this->render('addUser.html.twig', [
        ]);
    }

    #[Route('/editUser/{user_id}', name: 'app_editUser')]
    public function editUser(int $user_id, Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {

        $chosenUser = $entityManager->getRepository(Uzytkownicy::class)->find($user_id);

        if ($request->isMethod('POST')) 
        {

            $chosenUser->setLokalizacja($request->request->get('lokalizacja'));
            $chosenUser->setStanowisko($request->request->get('stanowisko'));
            $chosenUser->setTel($request->request->get('telefon'));

            $entityManager->persist($chosenUser);
            $entityManager->flush();

            $session->getFlashBag()->add('success', 'Użytkownik został pomyślnie zmodyfikowany.');
        }

        return $this->render('editUser.html.twig', [
            'chosenUser' => $chosenUser
        ]);
    }

}
