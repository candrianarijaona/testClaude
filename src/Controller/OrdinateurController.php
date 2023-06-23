<?php

namespace App\Controller;

use App\Entity\Ordinateur;
use App\Form\OrdinateurType;
use App\Repository\OrdinateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdinateurController extends AbstractController
{
    public function __construct(
        private readonly OrdinateurRepository $ordinateurRepository,
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    #[Route('/nos-pcs', name: 'app_ordinateur')]
    public function index(): Response
    {
        return $this->render('ordinateur/index.html.twig', [
            'ordinateurs' => $this->ordinateurRepository->getLast15minutes(),
        ]);
    }

    #[Route('/nos-pcs/ajout', name: 'app_ordinateur_add', methods: ['GET', 'POST'])]
    public function add(Request $request): Response
    {
        $ordinateur = new Ordinateur();
        $form = $this->createForm(OrdinateurType::class, $ordinateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($ordinateur);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_ordinateur');
        }

        return $this->render('ordinateur/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/nos-pcs/edit/{id}', name: 'app_ordinateur_edit', methods: ['GET', 'POST'])]
    public function edit(Ordinateur $ordinateur): Response
    {
        return $this->render('ordinateur/edit.html.twig', [
            'ordinateur' => $ordinateur,
        ]);
    }

    #[Route('/nos-pcs/detail/{id}', name: 'app_ordinateur_detail', methods: ['GET'])]
    public function show(Ordinateur $ordinateur): Response
    {
        return $this->render('ordinateur/show.html.twig', [
            'ordinateur' => $ordinateur,
        ]);
    }

    #[Route('/nos-pcs/remove/{id}', name: 'app_ordinateur_delete', methods: ['DELETE', 'POST'])]
    public function delete(Ordinateur $ordinateur): Response
    {
        $this->entityManager->remove($ordinateur);
        $this->entityManager->flush();
        return $this->redirectToRoute('app_ordinateur');
    }
}
