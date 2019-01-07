<?php

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping AS ORM;
use App\Domain\ValueObjects\Money;
use App\Exceptions\BusinessException;

/**
 * @ORM\Entity()
 */
final class Proposal extends Entity
{
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
        parent::__construct();

        $this->freelancer = $freelancer;
        $this->hourRate = $hourRate;
        $this->coverLetter = $coverLetter;
    }

    /**
     * @param \App\Domain\Entities\Proposal $other
     * @throws \App\Exceptions\BusinessException
     */
    public function checkCompatibility(Proposal $other)
    {
        if($this->freelancer->equals($other->freelancer)) {
            throw new BusinessException('This freelancer already made a proposal');
        }
    }
}