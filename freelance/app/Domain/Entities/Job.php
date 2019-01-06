<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\JobDescription;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity()
 */
final class Job extends EntityWithEvents
{
    /**
     * @var Client
     * @ORM\ManyToOne(targetEntity="App\Domain\Entities\Client")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @var JobDescription
     * @ORM\Embedded(class = "App\Domain\ValueObjects\JobDescription", columnPrefix = false)
     */
    private $description;

    /**
     * @var Proposal[] | \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Proposal", mappedBy="job",cascade={"persist"})
     */
    private $proposals;

    private function __construct(Client $client, JobDescription $description)
    {
        $this->client = $client;
        $this->description = $description;
        $this->proposals = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public static function post(Client $client, JobDescription $description): Job
    {
        return new Job($client, $description);
    }

    /**
     * @param \App\Domain\Entities\Freelancer $freelancer
     * @param string $coverLetter
     * @throws \App\Exceptions\BusinessException
     */
    public function apply(Freelancer $freelancer, string $coverLetter)
    {
        $newProposal = $freelancer->makeProposal($coverLetter);

        foreach ($this->proposals as $proposal)
        {
            $proposal->checkCompatibility($newProposal);
        }

        $this->proposals->add($newProposal);
    }

    public function getProposalsCount(): int
    {
        return $this->proposals->count();
    }
}