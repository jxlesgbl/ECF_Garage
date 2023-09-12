<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(ServiceRepository $serviceRepository): Response
    {
        $services = [
            [
                'title' => 'Vidange',
                'price' => '69.90',
                'image' => 'images/services/vidange.jpeg',
                'description' => 'Il est important de réaliser une fois par an au minimum la vidange de votre moteur, cela est essentiel à son bon fonctionnement et à la prolongation de sa durée de vie.'
            ],
            [
                'title' => 'Révision',
                'price' => '79.90',
                'image' => 'images/services/revision-voiture.jpg',
                'description' => 'La révision inclut la vidange, le changement des filtres à air, et un contrôle minutieux des organes de votre véhicule.'
            ],
            [
                'title' => 'Remplacement courroie de distribution',
                'price' => '199.90',
                'image' => 'images/services/courroie.jpeg',
                'description' => 'La courroie de distribution classique s\'effectue tous les 90 000km, cependant en fonction de votre moteur, il se peut qu\'elle soit à prévoir bien avant ce kilométrage (ex. Courroie à bain d\'huile du 1.2L Puretech turbo entre 2012 et 2017).'
            ],
            [
                'title' => 'Entretien/Recharge climatisation',
                'price' => '54.90',
                'image' => 'images/services/recharge-clim.jpeg',
                'description' => 'Votre clim ne produit plus d\'air frais? Pas d\'inquiétude! Grâce à notre gaz premium, repartez rafraichi ! En effet si la climatisation de votre véhicule n\'est pas souvent utilisée, le gaz peut s\'en échapper. Nous proposons aussi dans le cas d\'une fuite nos services en recherche de fuite.'
            ],
            [
                'title' => 'Remplacement plaquettes/disques de freins',
                'price' => '39.90',
                'image' => 'images/services/freins.jpeg',
                'description' => 'Organe essentiel à votre sécurité, l\'usure de ses consommables est évidemment un point crucial à vérifier. Nous vous offrons à cet effet nos services de remplacement de plaquettes et disques de freins'
            ],
            [
                'title' => 'Pneus',
                'price' => '49.90',
                'image' => 'images/services/pneus.jpeg',
                'description' => 'En contact direct avec l\'asphalte, ils sont le lien entre votre voiture et le sol. Leur état influence la tenue de route ainsi que les distances de freinage du véhicule.'
            ],
            [
                'title' => 'Amélioration de l\'éclairage',
                'price' => '200',
                'image' => 'images/services/eclairage.jpeg',
                'description' => 'Gagnez en visibilité la nuit, au fil du temps et de l\'utilisation, vos réflecteurs se détériorent à cause de la chaleur et des rayons UV produits par vos ampoules halogène. Faites appel à nous afin de retrouver une réflection neuve et améliorée par des années d\'innovation.'
            ],
            [
                'title' => 'Autres prestations',
                'price' => '60',
                'image' => 'images/services/autres-prestations.webp',
                'description' => 'Nous réalisons d\'autres opérations sur demande, prenez contact avec nous'
            ]
        ];

        $services = $serviceRepository->findAll();

        return $this->render('service/index.html.twig', [
            'services' => $services,
        ]);

    }

    #[Route('/admin/service/delete/{id}', name: 'delete_service')]
    public function delete(Request $request, EntityManagerInterface $entityManager, int $id, ServiceRepository $serviceRepository): Response
    {
        $service = $serviceRepository->find($id);

        if(!$service){
            throw $this->createNotFoundException('Service not found');
        }

        $entityManager->remove($service);
        $entityManager->flush();

        return $this->redirectToRoute('app_service');
    }

    #[Route('/admin/service/new', name: 'service_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $service = new Service();

        $form = $this->createForm(ServiceType::class, $service);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();
            $imageUrl = '';

            if ($image) {
                $newFilename = md5(uniqid()) . '.' . $image->guessExtension();

                $image->move($this->getParameter('images_directory'), $newFilename);

                $imageUrl = $this->getParameter('images_url_base') . '/' . $newFilename;
            }

            $service->setImage($imageUrl);

            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('app_service');
        }

        return $this->render('service/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
