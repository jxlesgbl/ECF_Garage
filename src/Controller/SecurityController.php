<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Utilisateur;
use App\Form\LoginType;
use App\Form\SignupType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\VarDumper\VarDumper;

class SecurityController extends AbstractController
{
    // #[Route('/signup', name: 'app_signup')]
    // public function signup(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    // {
    //     $utilisateur = new Utilisateur();

    //     if ($request->isMethod('POST')) {

    //         $email = $request->request->get('email');
    //         $password = $request->request->get('password');
    //         $nom = $request->request->get('nom');
    //         $prenom = $request->request->get('prenom');

    //         $utilisateur->setEmail($email);
    //         $utilisateur->setNom($nom);
    //         $utilisateur->setPrenom($prenom);

    //         $hashedPassword = $passwordHasher->hashPassword($utilisateur, $password);
    //         $utilisateur->setPassword($hashedPassword);

    //         $entityManager->persist($utilisateur);
    //         $entityManager->flush();


    //         $this->addFlash('success', 'Successfuly signed up! You can now login ☺️');

    //         return $this->redirectToRoute('app_login');
    //     }
    //     $form = $this->createForm(SignupType::class, $utilisateur);

    //     return $this->render('security/signup.html.twig', [
    //         'form' => $form->createView(),
    //         'utilisateur' => $utilisateur,
    //     ]);
    // }

    // #[Route('/create_admin', name: 'create_admin')]
    // public function createAdmin(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    // {
    //     $admin = $this->createAdminUser($passwordHasher, $entityManager);

    //     return $this->redirectToRoute('app_login');
    // }

    // public function createAdminUser(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
    // {
    //     $admin = new Utilisateur();
    //     $admin->setEmail('admin@garagevparrot.fr');
    //     $hashedPassword = $passwordHasher->hashPassword(
    //         $admin,
    //         'admin_passw0rd'
    //     );
    //     $admin->setPassword($hashedPassword);
    //     $admin->setRoles(['ROLE_ADMIN']);
    //     $admin->setNom('Admin');
    //     $admin->setPrenom('Admin');


    //     $entityManager->persist($admin);
    //     $entityManager->flush();

    //     return $admin;
    // }

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if($this->getUser())
        {
            return $this->redirectToRoute('app_home');
        }

        // $utilisateur = $this->getUser();

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        // $form = $this->createForm(LoginType::class, $utilisateur);

        return $this->render('security/login.html.twig', [
            // 'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {}
}
