<?php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiCustomerController extends AbstractController
{
    #[Route('/api/customer/{id}', name: 'app_api_customer')]
    public function index(Customer $customer): Response
    {
        return $this->json( $customer,
        200,
        []);
    }
}
