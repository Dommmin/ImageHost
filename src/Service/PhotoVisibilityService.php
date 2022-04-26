<?php

namespace App\Service;

use App\Entity\Photo;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class PhotoVisibilityService
{
    private PhotoRepository $photoRepository;
    private Security $security;
    private EntityManagerInterface $entityManager;

    public function __construct(PhotoRepository $photoRepository, Security $security, EntityManagerInterface $entityManager)
    {
        $this->photoRepository = $photoRepository;
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function makeVisible(int $id, bool $visibility)
    {
        $em = $this->entityManager;
        /** @var  $photo */
        $photo = $this->photoRepository->find($id);

        if ($this->isPhotoBelongToCurrentUser($photo)) {
            $photo->setIsPublic($visibility);
            $em->persist($photo);
            $em->flush();

            return true;
        }
        return false;
    }

    private function isPhotoBelongToCurrentUser(Photo $photo): bool
    {
        return $photo->getUser() === $this->security->getUser();
    }
}
