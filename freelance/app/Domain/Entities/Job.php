<?php

namespace App\Domain\Entities;

use App\Domain\Events\Job\JobPosted;
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

    protected function __construct(Client $client, JobDescription $description)
    {
        parent::__construct();

        $this->client = $client;
        $this->description = $description;
        $this->proposals = new \Doctrine\Common\Collections\ArrayCollection();

        $this->record(new JobPosted($this->getId()));
    }

    public static function post(Client $client, JobDescription $description): Job
    {
        return new Job($client, $description);
    }

    public function newProposal(Proposal $newProposal)
    {
        $this->proposals->map(function(Proposal $proposal) use ($newProposal) {
            $proposal->checkCompatibility($newProposal);
        });

        $this->proposals->add($newProposal);
    }
}