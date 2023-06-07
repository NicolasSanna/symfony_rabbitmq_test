<?php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;

class ApiCustomerController extends AbstractController
{
    #[Route('/api/customers', name: 'app_api_customers')]
    public function getCustomers(): Response
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://localhost:8001/testmicroservice/customers');
        $customers = $response->getContent();
        // dd($customers);
        $customers = json_decode($customers);
        return $this->json($customers, 200);
    }   

    #[Route('/api/customers/customer/add', name: 'app_api_add_customer', methods: ['POST'])]
    public function createCustomer(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $objectToArray = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname']
        ];

        $client = HttpClient::create();
        $response = $client->request('POST', 'http://localhost:8001/testmicroservice/customers/customer/create', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($objectToArray), // Remplacez les données avec les valeurs appropriées
        ]);
        $data = $response->toArray();
        
        return $this->json($data, 200);
    }

    #[Route('/api/customers/customer/{id}', name: 'app_api_customer')]
    public function getCustomer(int $id): Response
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://localhost:8001/testmicroservice/customers/customer/' . $id);
        $data = $response->getContent();
        $customer = json_decode($data);
        
        return $this->json($customer, 200);
    }    
    
    

    #[Route('/api/customers/customer/delete/{id}', name: 'app_api_del_customer', methods: ['DELETE'])]
    public function deleteCustomer(int $id): Response
    {
        $client = HttpClient::create();
        $response = $client->request('DELETE', 'http://localhost:8001/testmicroservice/customers/customer/delete/' . $id);
        $data = $response->getContent();
        
        return $this->json(json_decode($data), 200);
    }

    #[Route('/api/customers/customer/edit/{id}', name: 'app_api_edit_customer', methods: ['PUT'])]
    public function editCustomer(int $id, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $objectToArray = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname']
        ];
        
        $client = HttpClient::create();
        $response = $client->request('PUT', 'http://localhost:8001/testmicroservice/customers/customer/edit/' . $id, [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($objectToArray), // Remplacez les données avec les valeurs appropriées
        ]);
        $data = json_decode($response->getContent(), true);
        
        return $this->json($data, 200);
    }
}
