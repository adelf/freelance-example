<?php

namespace App\ReadModels;

/**
 * App\ReadModels\Job
 *
 * @property int $id
 * @property mixed $client_id
 * @property string $title
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ReadModels\Proposal[] $proposals
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Job query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Job whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Job whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Job whereTitle($value)
 * @mixin \Eloquent
 */
final class Job extends ReadModel
{
    public $incrementing = false;

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'job_id', 'id');
    }
}