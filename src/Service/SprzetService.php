<?php

namespace App\Service;

use App\Entity\Sprzet;
use Doctrine\ORM\EntityManagerInterface;

class SprzetService {

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createProduct($hostname, $id_modelu, $typ, $producent, $nazwa, $przeznaczenie, $data_zakupu): Sprzet
    {
        $sprzet = new Sprzet();
        $sprzet->setHostname($hostname);
        $sprzet->setIdModelu($id_modelu);
        $sprzet->setTyp($typ);
        $sprzet->setProducent($producent);
        $sprzet->setNazwa($nazwa);
        $sprzet->setPrzeznaczenie($przeznaczenie);
        $sprzet->setDataZakupu($data_zakupu);

        $this->entityManager->persist($sprzet);
        $this->entityManager->flush();

        return $sprzet;
    }

}