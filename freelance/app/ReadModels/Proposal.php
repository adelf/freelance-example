<?php

namespace App\ReadModels;

/**
 * App\ReadModels\Proposal
 *
 * @property int $id
 * @property mixed|null $job_id
 * @property mixed $freelancer_id
 * @property string $cover_letter
 * @property int $hourRate_amount
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Proposal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Proposal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Proposal query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Proposal whereCoverLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Proposal whereFreelancerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Proposal whereHourRateAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Proposal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Proposal whereJobId($value)
 * @mixin \Eloquent
 */
final class Proposal extends ReadModel
{
}