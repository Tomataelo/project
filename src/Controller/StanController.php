<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Modele;


class StanController extends AbstractController
{
    #[Route('/stan', name: 'app_stan')]
    public function stan(EntityManagerInterface $entityManager, Request $request, SessionInterface $session): Response
    {

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
}