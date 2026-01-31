<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfilType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfilController extends AbstractController
{
    #[Route('/profil/{id}', name: 'app_profil')]
    public function index(User $user, EntityManagerInterface $em, Request $request): Response
    {
        // Vérifie qu'il sagit bien de l'utilisateur connecté
        if ($this->getUser() !== $user) {
            $currentUser = $this->getUser();
            if ($currentUser instanceof User) {
                return $this->redirectToRoute('app_profil', ['id' => $currentUser->getId()]);
            }
        }

        $form = $this->createForm(ProfilType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setCreatedAt(new DateTimeImmutable());
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Votre profil à bien été édité');
            return $this->redirectToRoute('app_profil', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('profil/index.html.twig', [
            'controller_name' => 'Bob-Aventure - Mon Profil',
            'user' => $user,
            'form' => $form
        ]);
    }
}
