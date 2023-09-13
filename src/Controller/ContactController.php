<?php

namespace App\Controller;

use App\Entity\WeeklyOpeningHours;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, string $subject = null, EntityManagerInterface $em): Response
    {
        $openingHours = $em->getRepository(WeeklyOpeningHours::class)->findAll();

        $form = $this->createForm(ContactFormType::class, null, ['subject' => $subject]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $name = $data['name'];
            $email = $data['email'];
            $phoneNumber = $data['phoneNumber'];
            $subject = $data['subject'];
            $message = $data['message'];

            // You can access the car title from the URL or any other way
            // Example: $carTitle = $request->query->get('carTitle');
            // Then use $carTitle in your email

            // $message = (new \Swift_Message('Contact Request - ' . $subject))
            //     ->setFrom('your_email@example.com')
            //     ->setTo('recipient@example.com')
            //     ->setBody(
            //         $this->renderView(
            //             'emails/contact.html.twig',
            //             ['message' => $message]
            //         ),
            //         'text/html'
            //     );

            // $mailer->send($message);

            // $this->addFlash('success', 'Your message has been sent successfully.');

            return $this->redirectToRoute('app_car_list'); // Redirect to your car list page or any other page
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'openingHours' => $openingHours,
        ]);
    }
}
