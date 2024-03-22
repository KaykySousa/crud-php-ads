<?php

namespace App\Model;

class Customer {
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $city;
    private ?string $state;

    public function __construct(array $data) {
        $this->id = $data['cliente_id'];
        $this->name = $data['nome'];
        $this->email = $data['email'];
        $this->city = $data['cidade'];
        $this->state = $data['estado'];
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    public function getCity(): ?string {
        return $this->city;
    }

    public function setCity(?string $city): void {
        $this->city = $city;
    }

    public function getState(): ?string {
        return $this->state;
    }

    public function setState(?string $state): void {
        $this->state = $state;
    }
}
