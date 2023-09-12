<?php

namespace App\Controller;

use App\Entity\WeeklyOpeningHours;
use App\Form\WeeklyOpeningHoursType;
use App\Repository\OpeningHoursRepository;
use App\Repository\ServiceRepository;
use App\Repository\TestimonialRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{


    #[Route('/admin/users', name: 'app_admin_users')]
    public function manageUsers(UtilisateurRepository $utilisateurRepository): Response
    {
        $users = $utilisateurRepository->findAll();

        return $this->render('admin/users.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/admin/opening-hours', name: 'admin_opening_hours')]
    public function manageOpeningHours(Request $request, EntityManagerInterface $em)
    {
        $openingHours = $em->getRepository(WeeklyOpeningHours::class)->findAll();
        // $weeklyOpeningHours = new WeeklyOpeningHours();
        // $weeklyOpeningHours->setOpeningTime($openingHours);

        $form = $this->createForm(WeeklyOpeningHoursType::class, ['openingHours' => $openingHours]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('admin_opening_hours');
        }

        return $this->render('admin/opening-hours.html.twig', [
            'opening_hours' => $openingHours,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/services', name: 'admin_services')]
    public function manageServices(ServiceRepository $serviceRepository)
    {
        $services = $serviceRepository->findAll();

        return $this->render('admin/services.html.twig', [
            'services' => $services,
        ]);
    }

    #[Route('/admin/approve-testimonials', name: 'admin_testimonials')]
    public function approveTestimonials(TestimonialRepository $testimonialRepository)
    {
        $testimonials = $testimonialRepository->findAll();

        return $this->render('admin/testimonials.html.twig', [
            'testimonials' => $testimonials,
        ]);
    }
}
