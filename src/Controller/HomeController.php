<?php

namespace App\Controller;

use App\Data\DataInsertion;
use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, CustomerRepository $customerRepository, MessageBusInterface $bus): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {

        //     sleep(10);

        //     $customerRepository->save($customer, true);

        //     return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        // }

        if ($form->isSubmitted() && $form->isValid()) {

            $bus->dispatch(New DataInsertion($form->get('firstname')->getData(), $form->get('lastname')->getData()));

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('customer/new.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }
}
