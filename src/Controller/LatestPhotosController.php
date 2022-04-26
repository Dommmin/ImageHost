<?php

namespace App\Controller;

use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LatestPhotosController extends AbstractController
{
    #[Route('/latest', name: 'latest_photos')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $latestPhotosPublic = $entityManager->getRepository(Photo::class)->findAllPublic();

        return $this->render('latest_photos/latest.html.twig', [
            'latestPhotosPublic' => $latestPhotosPublic,
        ]);
    }
}
