<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        $regularUser = new User();
        $regularUser
            ->setEmail('bob@test.com')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->hasher->hashPassword($regularUser, 'bob'))
            ->setFirstname('bob')
            ->setLastname('test');

        $manager->persist($regularUser);

        $adminUser = new User();
        $adminUser
            ->setEmail('admin@test.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($adminUser, 'admin'))
            ->setFirstname('admin')
            ->setLastname('test');

        $manager->persist($adminUser);

        $manager->flush();
    }
}
