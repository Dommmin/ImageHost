<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\User;
use App\Form\UploadPhotoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UploadController extends AbstractController
{
    #[Route('/', name: 'upload')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(UploadPhotoType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $this->getUser()) {
            /** @var UploadedFile $pictureFilename */
            $pictureFilename = $form->get('filename')->getData();
            if ($pictureFilename){
                try {
                    $originalFilename = pathinfo($pictureFilename->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFileName = transliterator_transliterate('Any-Latin; Latin-ASCII; [] remove; LoweR()',$originalFilename);
                    $newFileName = $safeFileName . '-' . uniqid('', true) . '.' . $pictureFilename->guessExtension();
                    $pictureFilename->move('images/hosting', $newFileName);

                    $entityPhotos = new Photo();
                    $entityPhotos->setFilename($newFileName);
                    $entityPhotos->setIsPublic($form->get('is_public')->getData());
                    $entityPhotos->setUploadedAt(new \DateTime());
                    $entityPhotos->setUser($user);

                    $entityManager->persist($entityPhotos);
                    $entityManager->flush();
                    $this->addFlash('success', 'Dodano zdjęcie!');
                }catch (\Exception $e){
                    $this->addFlash('error', 'Wystąpił nieoczekiwany błąd!');
                }
            }
        }

        return $this->render('upload/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
