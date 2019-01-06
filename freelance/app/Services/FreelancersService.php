<?php

namespace App\Services;

use App\Domain\Entities\Freelancer;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Money;
use App\Exceptions\EntityNotFoundException;
use App\Infrastructure\StrictEntityManager;

final class FreelancersService
{
    /** @var StrictEntityManager */
    private $entityManager;

    public function __construct(StrictEntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Return freelancers's id.
     *
     * @param \App\Domain\ValueObjects\Email $email
     * @param \App\Domain\ValueObjects\Money $hourRate
     * @return int
     */
    public function register(Email $email, Money $hourRate): int
    {
        $freelancer = new Freelancer($email, $hourRate);

        $this->entityManager->persist($freelancer);
        $this->entityManager->flush();

        return $freelancer->getId();
    }

    public function getById(int $id): Freelancer
    {
        /** @var Freelancer $freelancer */
        $freelancer = $this->entityManager->findOrFail(Freelancer::class, $id);

        return $freelancer;
    }
}