<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Model\Customer;
use PDOException;

class CustomerController extends Controller {

    public function index() {
        try {
            $customerRepository = new CustomerRepository();

            $customers = $customerRepository->findAll();

            $customersData = [];

            foreach ($customers as $customer) {
                $customersData[] = [
                    "id" => $customer->getId(),
                    "nome" => $customer->getName(),
                    "email" => $customer->getEmail(),
                    "cidade" => $customer->getCity(),
                    "estado" => $customer->getState()
                ];
            }

            http_response_code(200);
            echo json_encode($customersData);
        } catch (PDOException $e) {
            $status = 500;
            http_response_code($status);
            echo json_encode(["error" => [
                "message" => $e->getMessage(),
                "status" => $status
            ]]);
        }
    }

    public function show($id) {
        try {
            $customerRepository = new CustomerRepository();

            $customer = $customerRepository->findById($id);

            if (!$customer) {
                $status = 404;
                http_response_code($status);
                echo json_encode(["error" => [
                    "message" => "Customer not found",
                    "status" => $status
                ]]);
                return;
            }

            http_response_code(200);
            echo json_encode([
                "id" => $customer->getId(),
                "nome" => $customer->getName(),
                "email" => $customer->getEmail(),
                "cidade" => $customer->getCity(),
                "estado" => $customer->getState()
            ]);
        } catch (PDOException $e) {
            $status = 500;
            http_response_code($status);
            echo json_encode(["error" => [
                "message" => $e->getMessage(),
                "status" => $status
            ]]);
        }
    }

    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $customerRepository = new CustomerRepository();

            $customer = new Customer($data);
            $createdCustomer = $customerRepository->create($customer);

            http_response_code(201);
            echo json_encode([
                "id" => $createdCustomer->getId(),
                "nome" => $createdCustomer->getName(),
                "email" => $createdCustomer->getEmail(),
                "cidade" => $createdCustomer->getCity(),
                "estado" => $createdCustomer->getState()
            ]);
        } catch (PDOException $e) {
            $status = 500;
            http_response_code($status);
            echo json_encode(["error" => [
                "message" => $e->getMessage(),
                "status" => $status
            ]]);
        }
    }

    public function update($id) {

        if (empty($id)) {
            $status = 400;
            http_response_code($status);
            echo json_encode(["error" => [
                "message" => "Missing parameters (id)",
                "status" => $status
            ]]);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $customerRepository = new CustomerRepository();

            $customer = $customerRepository->update($id, $data);

            if (!$customer) {
                $status = 404;
                http_response_code($status);
                echo json_encode(["error" => [
                    "message" => "Customer not found",
                    "status" => $status
                ]]);
                return;
            }

            http_response_code(200);
            echo json_encode([
                "id" => $customer->getId(),
                "nome" => $customer->getName(),
                "email" => $customer->getEmail(),
                "cidade" => $customer->getCity(),
                "estado" => $customer->getState()
            ]);
        } catch (PDOException $e) {
            $status = 500;
            http_response_code($status);
            echo json_encode(["error" => [
                "message" => $e->getMessage(),
                "status" => $status
            ]]);
        }
    }

    public function destroy($id) {

        if (empty($id)) {
            $status = 400;
            http_response_code($status);
            echo json_encode(["error" => [
                "message" => "Missing parameters (id)",
                "status" => $status
            ]]);
            return;
        }

        try {
            $customerRepository = new CustomerRepository();

            $success = $customerRepository->delete($id);

            http_response_code(200);
            echo json_encode(["success" => $success]);
        } catch (PDOException $e) {
            $status = 500;
            http_response_code($status);
            echo json_encode(["error" => [
                "message" => $e->getMessage(),
                "status" => $status
            ]]);
        }
    }
}
