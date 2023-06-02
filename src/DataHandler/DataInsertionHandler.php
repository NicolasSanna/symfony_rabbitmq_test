<?php

namespace App\DataHandler;

use App\Data\DataInsertion;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CustomerRepository;
use App\Entity\Customer;

class DataInsertionHandler implements MessageHandlerInterface
{
    private CustomerRepository $customerRepository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function __invoke(DataInsertion $dataInsertion)
    {
        $customer = new Customer();
        $customer->setFirstname($dataInsertion->getFirstname());
        $customer->setlastname($dataInsertion->getLastname());
        sleep(10);
        $this->customerRepository->save($customer, true);
    }
}