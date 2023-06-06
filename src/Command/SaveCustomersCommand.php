<?php

namespace App\Command;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\DBAL\Connection;

#[AsCommand(
    name: 'app:save-customers',
    description: 'Sauvegarde de clients dans la table',
)]
class SaveCustomersCommand extends Command
{
    private Connection $connection;
    private CustomerRepository $customerRepository;
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            // ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            // ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
            ->setName('app:save-customers')
            ->setDescription('Sauvegarde de clients dans la table')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        // $arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        // $questionHelper = $this->getHelper('question');
        // $confirmationQuestion = new ConfirmationQuestion('Symfony do you want to run [yes]? ', true);

        // // Set the default answer to "yes"
        // $confirmationQuestion->setHidden(true);
        // if (!$questionHelper->ask($input, $output, $confirmationQuestion)) {
        //     // User answered "no"
        //     $io->error('Commande annulée');
        //     return Command::SUCCESS;
        // }


        // for($i = 1 ; $i <= 10 ; $i++)
        // {
        //     $customer = new Customer();
        //     $customer   ->setFirstname(sprintf('Prénom N°%d', $i))
        //                 ->setLastname(sprintf('NOM N°%d', $i));
        //     $this->customerRepository->save($customer, true);
        // }

        $sql = 'CALL SP_ArchiveCustomersInsert();';

        $this->connection->executeQuery($sql);

        $io->success('Tous les utilisateurs ont été archivés');

        return Command::SUCCESS;
    }
}
