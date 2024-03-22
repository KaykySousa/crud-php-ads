<?php

namespace App\Repository;

use App\Database\Database;
use App\Model\Customer;
use PDO;

class CustomerRepository {

    private PDO $db;

    public function __construct() {
        $this->db = (new Database())->getInstance();
    }

    public function findAll() {
        $query = "SELECT * FROM clientes";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $customersData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $customers = [];

        foreach ($customersData as $data) {
            $customer = new Customer($data);
            $customers[] = $customer;
        }

        return $customers;
    }

    public function findById($id) {
        $query = "SELECT * FROM clientes WHERE cliente_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $customer = new Customer($data);

        return $customer;
    }

    public function create(Customer $customer) {
        $query = "INSERT INTO clientes (nome, email, cidade, estado) VALUES (:name, :email, :city, :state)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":name", $customer->getName());
        $stmt->bindParam(":email", $customer->getEmail());
        $stmt->bindParam(":city", $customer->getCity());
        $stmt->bindParam(":state", $customer->getState());

        $stmt->execute();

        $customer->setId($this->db->lastInsertId());

        return $customer;
    }

    public function update($id, array $data) {
        $customer = $this->findById($id);

        if (!$customer) {
            return null;
        }

        if (!empty($data['nome'])) {
            $customer->setName($data['nome']);
        }

        if (!empty($data['email'])) {
            $customer->setEmail($data['email']);
        }

        if (!empty($data['cidade'])) {
            $customer->setCity($data['cidade']);
        }

        if (!empty($data['estado'])) {
            $customer->setState($data['estado']);
        }

        $query = "UPDATE clientes SET nome = :name, email = :email, cidade = :city, estado = :state WHERE cliente_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":name", $customer->getName());
        $stmt->bindParam(":email", $customer->getEmail());
        $stmt->bindParam(":city", $customer->getCity());
        $stmt->bindParam(":state", $customer->getState());
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $customer;
    }

    public function delete($id) {
        $query = "DELETE FROM clientes WHERE cliente_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}
