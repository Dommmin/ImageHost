<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\User;
use App\Service\PhotoVisibilityService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class MyController extends AbstractController
{
    #[Route('/my_photos/photos', name: 'my_photos')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        /** @var Photo $myPhotos */
        $myPhotos = $entityManager->getRepository(Photo::class)->findBy(['user' => $this->getUser()]);

        return $this->render('my_photos/my.html.twig', [
            'myPhotos' => $myPhotos,
        ]);
    }

    /**
     * @param PhotoVisibilityService $photoVisibilityService
     * @param int $id
     * @param bool $visibility
     * @return RedirectResponse
     */
    #[Route('/my_photos/photos/set_visibility/{id}/{visibility}', name: 'my_photos_set_visibility')]
    public function myPhotoChangeVisibility(PhotoVisibilityService $photoVisibilityService, int $id, bool $visibility): RedirectResponse
    {
        /** @var array $messages */
        $messages = [
            '1' => 'public',
            '0' => 'private',
        ];

        if ($photoVisibilityService->makeVisible($id, $visibility)){

            $this->addFlash('success', 'Set as ' . $messages[$visibility] . '.');
        } else {
            $this->addFlash('error', 'An error occured with set as ' . $messages[$visibility] . '.');
        }

        return $this->redirectToRoute('my_photos');
    }

    #[Route('/my_photos/photos/remove/{id}', name: 'my_photos_remove')]
    public function myPhotoRemove(EntityManagerInterface $entityManager, int $id): RedirectResponse
    {
        /** @var Photo $myPhoto */
        $myPhoto = $entityManager->getRepository(Photo::class)->find($id);

        /** @var User $user */
        $user = $this->getUser();

        $myPhoto = $entityManager->getRepository(Photo::class)->find($id);

//        $this->denyAccessUnlessGranted('ROLE_USER');
        if ($user === $myPhoto->getUser())
            {
                $fileManager = new FileSystem();
                $fileManager->remove('images/hosting/'.$myPhoto->getFilename());
                if ($fileManager->exists('images/hosting/'.$myPhoto->getFilename())) {
                    $this->addFlash('error', 'Cannot delete photo!');
                } else {
                    $entityManager->remove($myPhoto);
                    $entityManager->flush();
                    $this->addFlash('success', 'Photo deleted!');
                }
            } else {
                $this->addFlash('error', 'You cannot delete this photo! You are not owner!');
            }

            return $this->redirectToRoute('my_photos');
    }
}
