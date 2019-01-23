<?php

namespace App\Domain\Entities;

use App\Domain\Events\Job\JobPosted;
use App\Domain\ValueObjects\JobDescription;
use App\Domain\ValueObjects\Money;
use Doctrine\ORM\Mapping AS ORM;
use Ramsey\Uuid\UuidInterface;

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
     * @ORM\OneToMany(targetEntity="Proposal", mappedBy="job", cascade={"persist"})
     */
    private $proposals;

    protected function __construct(UuidInterface $id, Client $client, JobDescription $description)
    {
        parent::__construct($id);

        $this->client = $client;
        $this->description = $description;
        $this->proposals = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public static function post(UuidInterface $id, Client $client, JobDescription $description): Job
    {
        $job = new Job($id, $client, $description);
        $job->record(new JobPosted($job->getId()));

        return $job;
    }

    /**
     * @param Freelancer $freelancer
     * @param Money $hourRate
     * @param string $coverLetter
     * @throws \App\Exceptions\Job\SameFreelancerProposalException
     */
    public function addProposal(Freelancer $freelancer, Money $hourRate, string $coverLetter)
    {
        $newProposal = new Proposal($this, $freelancer, $hourRate, $coverLetter);

        foreach($this->proposals as $proposal)
        {
            $proposal->checkCompatibility($newProposal);
        }

        $this->proposals->add($newProposal);
    }
}