<?php

namespace App\Modele;

use App\Entity\Modele;
use Doctrine\ORM\EntityManagerInterface;

class ModeleService {

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createModel($typ, $nazwa, $producent, $przeznaczenie, $data_zakupu): Modele
    {
        $modele= new Modele();
        $modele->setTyp($typ);
        $modele->setNazwa($nazwa);
        $modele->setProducent($producent);
        $modele->setNazwa($nazwa);
        $modele->setPrzeznaczenie($przeznaczenie);
        $modele->setDataZakupu($data_zakupu);

        $this->entityManager->persist($modele);
        $this->entityManager->flush();

        return $modele;
    }

}