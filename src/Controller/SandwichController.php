<?php

namespace App\Controller;

use App\Entity\Sandwich;
use App\Repository\SandwichRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Serializer;

class SandwichController extends AbstractController
{
    #[Route('/api/sandwich', name: 'app_sandwich')]
    public function index(SandwichRepository $sandwichRepository): Response
    {
        $sandwiches = $sandwichRepository->findAll();

        return $this->json($sandwiches, 200, [],['groups' => ['sandwichesjson']]);
    }

    #[Route('/api/show/{id}', name: 'app_sandwich_show', methods: ['GET'])]
    public function show(Sandwich $sandwich): Response
    {

        return $this->json($sandwich, 200, [], ['groups' => ['sandwichesjson']]);
    }

    #[Route('/api/delete/{id}', name: 'app_sandwich_delete', methods: ['DELETE'])]
    public function delete(Sandwich $sandwich, EntityManagerInterface $manager): Response
    {
        $manager->remove($sandwich);
        $manager->flush();

        return $this->json(['message' => 'Sandwich deleted successfully'], 200, [], ['groups' => ['sandwichesjson']]);
    }
}

