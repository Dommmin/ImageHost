<?php

namespace App\DataFixtures;

use App\Entity\Photo;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@localhost.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));

        $user2 = new User();
        $user2->setUsername('john');
        $user2->setEmail('john@localhost.com');
        $user2->setRoles(['ROLE_USER']);
        $user2->setPassword($this->passwordHasher->hashPassword($user, 'doe'));

        $user3 = new User();
        $user3->setUsername('user');
        $user3->setEmail('user@localhost.com');
        $user3->setRoles(['ROLE_USER']);
        $user3->setPassword($this->passwordHasher->hashPassword($user, 'user'));

        $photo = new Photo();
        $photo->setFilename('1.jpg');
        $photo->setIsPublic('1');
        $photo->setUser($user);
        $photo->setUploadedAt(new \DateTime());

        $photo2 = new Photo();
        $photo2->setFilename('2.jpg');
        $photo2->setIsPublic('1');
        $photo2->setUser($user2);
        $photo2->setUploadedAt(new \DateTime());

        $photo3 = new Photo();
        $photo3->setFilename('3.jpg');
        $photo3->setIsPublic('1');
        $photo3->setUser($user3);
        $photo3->setUploadedAt(new \DateTime());

        $photo4 = new Photo();
        $photo4->setFilename('4.jpg');
        $photo4->setIsPublic('1');
        $photo4->setUser($user);
        $photo4->setUploadedAt(new \DateTime());

        $photo5 = new Photo();
        $photo5->setFilename('5.jpg');
        $photo5->setIsPublic('1');
        $photo5->setUser($user2);
        $photo5->setUploadedAt(new \DateTime());

        $photo6 = new Photo();
        $photo6->setFilename('6.jpg');
        $photo6->setIsPublic('1');
        $photo6->setUser($user3);
        $photo6->setUploadedAt(new \DateTime());

        $photo7 = new Photo();
        $photo7->setFilename('7.jpg');
        $photo7->setIsPublic('1');
        $photo7->setUser($user);
        $photo7->setUploadedAt(new \DateTime());

        $photo8 = new Photo();
        $photo8->setFilename('8.jpg');
        $photo8->setIsPublic('1');
        $photo8->setUser($user2);
        $photo8->setUploadedAt(new \DateTime());

        $photo9 = new Photo();
        $photo9->setFilename('9.jpg');
        $photo9->setIsPublic('1');
        $photo9->setUser($user3);
        $photo9->setUploadedAt(new \DateTime());

        $photo10 = new Photo();
        $photo10->setFilename('10.jpg');
        $photo10->setIsPublic('1');
        $photo10->setUser($user);
        $photo10->setUploadedAt(new \DateTime());

        $photo11 = new Photo();
        $photo11->setFilename('11.jpg');
        $photo11->setIsPublic('1');
        $photo11->setUser($user2);
        $photo11->setUploadedAt(new \DateTime());

        $photo12 = new Photo();
        $photo12->setFilename('12.jpg');
        $photo12->setIsPublic('1');
        $photo12->setUser($user3);
        $photo12->setUploadedAt(new \DateTime());

        $photo13 = new Photo();
        $photo13->setFilename('13.jpg');
        $photo13->setIsPublic('1');
        $photo13->setUser($user);
        $photo13->setUploadedAt(new \DateTime());

        $photo14 = new Photo();
        $photo14->setFilename('14.jpg');
        $photo14->setIsPublic('1');
        $photo14->setUser($user2);
        $photo14->setUploadedAt(new \DateTime());

        $photo15 = new Photo();
        $photo15->setFilename('15.jpg');
        $photo15->setIsPublic('1');
        $photo15->setUser($user3);
        $photo15->setUploadedAt(new \DateTime());

        $photo16 = new Photo();
        $photo16->setFilename('16.jpg');
        $photo16->setIsPublic('1');
        $photo16->setUser($user);
        $photo16->setUploadedAt(new \DateTime());

        $photo17 = new Photo();
        $photo17->setFilename('17.jpg');
        $photo17->setIsPublic('1');
        $photo17->setUser($user2);
        $photo17->setUploadedAt(new \DateTime());

        $photo18 = new Photo();
        $photo18->setFilename('18.jpg');
        $photo18->setIsPublic('1');
        $photo18->setUser($user3);
        $photo18->setUploadedAt(new \DateTime());

        $photo19 = new Photo();
        $photo19->setFilename('19.jpg');
        $photo19->setIsPublic('1');
        $photo19->setUser($user);
        $photo19->setUploadedAt(new \DateTime());

        $photo20 = new Photo();
        $photo20->setFilename('20.jpg');
        $photo20->setIsPublic('1');
        $photo20->setUser($user2);
        $photo20->setUploadedAt(new \DateTime());

        $photo21 = new Photo();
        $photo21->setFilename('21.jpg');
        $photo21->setIsPublic('1');
        $photo21->setUser($user3);
        $photo21->setUploadedAt(new \DateTime());

        $photo22 = new Photo();
        $photo22->setFilename('22.jpg');
        $photo22->setIsPublic('1');
        $photo22->setUser($user);
        $photo22->setUploadedAt(new \DateTime());




        $manager->persist($user);
        $manager->persist($user2);
        $manager->persist($user3);

        $manager->persist($photo);
        $manager->persist($photo2);
        $manager->persist($photo3);
        $manager->persist($photo4);
        $manager->persist($photo5);
        $manager->persist($photo6);
        $manager->persist($photo7);
        $manager->persist($photo8);
        $manager->persist($photo9);
        $manager->persist($photo10);
        $manager->persist($photo11);
        $manager->persist($photo12);
        $manager->persist($photo13);
        $manager->persist($photo14);
        $manager->persist($photo15);
        $manager->persist($photo16);
        $manager->persist($photo17);
        $manager->persist($photo18);
        $manager->persist($photo19);
        $manager->persist($photo20);
        $manager->persist($photo21);
        $manager->persist($photo22);

        $manager->flush();
    }
}
