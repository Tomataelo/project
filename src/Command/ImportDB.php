<?php
namespace App\Command;

use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use App\Entity\Modele;

#[AsCommand(
    name: 'app:importDB',
)]
class ImportDB extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $dsn = "mysql:host=localhost;dbname=stan_magazynowy;charset=utf8";
        $username = "root";
        $password = "";

        try 
        {
            $pdo = new \PDO($dsn, $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $output->writeln('Połączono z bazą danych.');

            $statement = $pdo->query("SELECT * FROM modele");
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

            foreach($results as $modele) {
                
                $model = new Modele();

                $model->setTyp($modele['typ']);
                $model->setNazwa($modele['nazwa']);
                $model->setProducent($modele['producent']);
                $model->setSystemOperacyjny($modele['system_operacyjny']);
                $model->setCpu($modele['cpu']);
                $model->setRam($modele['ram']);
                $model->setDysk($modele['dysk']);
                $model->setPrzeznaczenie($modele['przeznaczenie']);
                $model->setIloscOgolna($modele['ilosc_ogolna']);
                
                $this->entityManager->persist($model);
                $this->entityManager->flush();
            }
        } 
        catch (\PDOException $e) 
        {
            $output->writeln('Błąd połączenia z bazą danych: ' . $e->getMessage());
        }

        return Command::SUCCESS;
    }
}