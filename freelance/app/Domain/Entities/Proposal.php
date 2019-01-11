<?php

namespace App\Domain\Entities;

use App\Exceptions\Job\SameFreelancerProposalException;
use Doctrine\ORM\Mapping AS ORM;
use App\Domain\ValueObjects\Money;

/**
 * @ORM\Entity()
 */
final class Proposal
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer", unique=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * This column is needed only for mapping
     * @ORM\ManyToOne(targetEntity="Job", inversedBy="proposals")
     * @ORM\JoinColumn(name="job_id", referencedColumnName="id")
     */
    private $job;

    /**
     * @var Freelancer
     * @ORM\ManyToOne(targetEntity="App\Domain\Entities\Freelancer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $freelancer;

    /**
     * @var Money
     * @ORM\Embedded(class = "App\Domain\ValueObjects\Money")
     */
    private $hourRate;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $coverLetter;

    public function __construct(Freelancer $freelancer, Money $hourRate, string $coverLetter)
    {
        $this->freelancer = $freelancer;
        $this->hourRate = $hourRate;
        $this->coverLetter = $coverLetter;
    }

    /**
     * @param \App\Domain\Entities\Proposal $other
     * @throws SameFreelancerProposalException
     */
    public function checkCompatibility(Proposal $other)
    {
        if($this->freelancer->equals($other->freelancer)) {
            throw new SameFreelancerProposalException();
        }
    }
}