<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Form\FilterType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{

    #[Route('/car/list', name: 'app_car_list')]
    public function list(CarRepository $CarRepository, Request $request, EntityManagerInterface $entityManager): Response
    {

        $filterForm = $this->createForm(FilterType::class);

        // Handle the form submission
        $filterForm->handleRequest($request);

        $carRepository = $entityManager->getRepository(Car::class);

        // Check if the form is submitted and valid
        if ($filterForm->isSubmitted() && $filterForm->isValid()) {
            // Get the form data
            $formData = $filterForm->getData();
            $filteredCars = $carRepository->findByFilters($formData);
        } else {
            $filteredCars = $carRepository->findAll();
        }

        $renderedCars =  $this->render('car/index.html.twig', [
            'cars' => $filteredCars,
            'form' => $filterForm->createView(),
        ]);

        return new Response($renderedCars);
    }

    // #[Route('/car/{id}', name: 'app_car_show')]
    // public function show($id, CarRepository $CarRepository)
    // {
    //     return $this->render('car/car.html.twig', [
    //         'id' => $id,
    //     ]);
    // }

    #[Route('admin/car/new', name: 'car_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $car = new Car();

        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageUrls = [];

            $imageFiles = $form->get('imageFiles')->getData();

            foreach ($imageFiles as $imageFile) {
                $newFilename = md5(uniqid()) . '.' . $imageFile->guessExtension();

                $imageFile->move($this->getParameter('images_directory'), $newFilename);

                $imageUrl = $this->getParameter('images_url_base') . '/' . $newFilename;

                $imageUrls[] = $imageUrl;
            }
            $car->setImageGalleryArray($imageUrls);

            // $car = $form->getData();

            $entityManager->persist($car);
            $entityManager->flush();

            $this->addFlash('success', 'Annonce ajoutée');

            return $this->redirectToRoute('app_car_list');
        }

        return $this->render('car/new.html.twig', [
            'car' => $car,
            'form' => $form->createView(),
        ]);

    }

    #[Route('/admin/car/delete/{id}', name: 'car_delete')]
    public function delete(Request $request, EntityManagerInterface $entityManager, int $id, CarRepository $carRepository): Response
    {
        $car = $carRepository->find($id);

        if (!$car) {
            throw $this->createNotFoundException('Car not found');
        }

        $entityManager->remove($car);
        $entityManager->flush();

        $this->addFlash('success', 'Annonce supprimée');

        return $this->redirectToRoute('app_car_list'); // Redirect to the car list page after deletion

    }

}
