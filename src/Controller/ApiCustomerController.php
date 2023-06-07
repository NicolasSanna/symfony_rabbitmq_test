<?php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class ApiCustomerController extends AbstractController
{
    #[Route('/api/customer/{id}', name: 'app_api_customer')]
    public function index(int $id): Response
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://localhost:8001/testmicroservice/' . $id);
        $response = $response->toArray();
        
        return $this->json( $response,
        200,
        []);
    }
}
