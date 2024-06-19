<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Repository\LoginRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class LoginController extends AbstractController
{
    #[Route('/', name: 'app_login')]
    public function login(Request $request, LoginRepository $loginRepository, SessionInterface $session): Response
    {

        if ($request->isMethod('POST')) 
        {
            $username = $request->request->get('username');
            $password = $request->request->get('password');
            
            $user = $loginRepository->findByLoginAndPassword($username, $password);

            if ($user) 
            {
                return $this->redirect('/index');
            } 
            else 
            {
                $session->getFlashBag()->add('login_error', 'Nieprawidłowy login lub hasło');
                return $this->redirectToRoute('app_login');
            }
        }

        return $this->render('login.html.twig', []);
    }
}
