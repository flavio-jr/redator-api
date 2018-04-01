<?php

namespace App\Entities;

use App\Database\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\ORM\Id\UuidGenerator as Uuid;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories", uniqueConstraints={@UniqueConstraint(name="name", columns={"name"})})
 */
class Category implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $name;

    public function getId(): string
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function fromArray(array $data): void
    {
        $this->setName($data['name']);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName()
        ];
    }
}