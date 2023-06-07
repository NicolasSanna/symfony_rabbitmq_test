<?php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class ApiCustomerController extends AbstractController
{
    #[Route('/api/customers', name: 'app_api_customers')]
    public function getCustomers(): Response
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://localhost:8001/testmicroservice/');
        $data = $response->getContent();
        
        return $this->json($data, 200);
    }   

    #[Route('/api/customers/customer/{id}', name: 'app_api_customer')]
    public function getCustomer(int $id): Response
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://localhost:8001/testmicroservice/' . $id);
        $data = $response->getContent();
        
        return $this->json($data, 200);
    }    
    
    #[Route('/api/customers/customer/add', name: 'app_api_add_customer', methods: ['POST'])]
    public function createCustomer(): Response
    {
        $customer = new Customer();

        $client = HttpClient::create();
        $response = $client->request('POST', 'http://localhost:8001/testmicroservice/', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => $customer, // Remplacez les données avec les valeurs appropriées
        ]);
        $data = $response->getContent();
        
        return $this->json($data, 200);
    }

    #[Route('/api/customers/customer/{id}', name: 'app_api_del_customer', methods: ['DELETE'])]
    public function deleteCustomer(int $id): Response
    {
        $client = HttpClient::create();
        $response = $client->request('DELETE', 'http://localhost:8001/testmicroservice/' . $id);
        $data = $response->getContent();
        
        return $this->json($data, 200);
    }

    #[Route('/api/customers/customer/edit/{id}', name: 'app_api_edit_customer', methods: ['PUT'])]
    public function editCustomer(int $id): Response
    {
        $client = HttpClient::create();
        $response = $client->request('PUT', 'http://localhost:8001/testmicroservice/' . $id, [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => '{"name": "Updated Name"}', // Remplacez les données avec les valeurs appropriées
        ]);
        $data = $response->getContent();
        
        return $this->json($data, 200);
    }
}
