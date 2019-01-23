<?php

namespace App\ReadModels;

/**
 * App\ReadModels\Freelancer
 *
 * @property int $id
 * @property string $email
 * @property int $hourRate_amount
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Freelancer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Freelancer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Freelancer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Freelancer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Freelancer whereHourRateAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ReadModels\Freelancer whereId($value)
 * @mixin \Eloquent
 */
final class Freelancer extends ReadModel
{
    public $incrementing = false;
}