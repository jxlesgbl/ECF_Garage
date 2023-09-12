<?php

namespace App\Controller;

use App\Repository\CarRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CarRepository $carRepository, ServiceRepository $serviceRepository, ServiceController $serviceController): Response
    {
        $cars = $carRepository->findAll();

        $services = $serviceRepository->findAll();

        return $this->render('home/index.html.twig', [
            'cars' => $cars,
            'services' => $services,
        ]);
    }
}
