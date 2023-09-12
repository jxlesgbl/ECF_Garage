<?php

namespace App\Controller;

use App\Entity\Testimonial;
use App\Form\TestimonialType;
use App\Repository\TestimonialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

use function PHPUnit\Framework\isNull;

class TestimonialController extends AbstractController
{
    #[Route('/testimonial', name: 'testimonial_list')]
    public function index(TestimonialRepository $testimonialRepository): Response
    {
        $testimonials = $testimonialRepository->findAll();
        if(isNull($testimonials)){
            new Exception("No testimonial found.", 404);
        }
        return $this->render('testimonies/index.html.twig', [
            'testimonials' => $testimonials,
        ]);
    }

    #[Route('/testimonial/new', name:'testimonial_new')]
    public function create(Request $request, EntityManagerInterface $entityManager, SluggerInterface $sluggerInterface)
    {
        $testimonial = new Testimonial();
        $form = $this->createForm(TestimonialType::class, $testimonial);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testimonial);
            $entityManager->flush();

            return $this->redirectToRoute('testimonial_list');
        }

        return $this->render('testimonies/new.html.twig', [
            'form' => $form->createView(),
            'testimonial' => $testimonial,
        ]);
    }
}
