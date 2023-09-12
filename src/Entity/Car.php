<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $model = null;

    #[ORM\Column(length: 255)]
    private ?string $year = null;

    #[ORM\Column]
    private ?int $mileage = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageGallery = null;

    // Transient property for handling image gallery as an array
    private ?array $imageGalleryArray = null;

    #[ORM\Column(nullable: true)]
    private ?array $caracteristics = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImageGallery(): ?string
    {
        return $this->imageGallery;
    }

    public function setImageGallery(?string $imageGallery): static
    {
        $this->imageGallery = $imageGallery;

        return $this;
    }

    public function getImageGalleryArray(): ?array
    {
        if ($this->imageGalleryArray === null && $this->imageGallery !== null) {
            $this->imageGalleryArray = explode(',', $this->imageGallery);
        }

        return $this->imageGalleryArray;
    }

    public function setImageGalleryArray(array $imageGalleryArray): void
    {
        $this->imageGalleryArray = $imageGalleryArray;
        $this->imageGallery = implode(',', $imageGalleryArray);
    }


    public function getCaracteristics(): ?array
    {
        return $this->caracteristics;
    }

    public function setCaracteristics(?array $caracteristics): static
    {
        $this->caracteristics = $caracteristics;

        return $this;
    }
}
