<?php

namespace App\Entities\HorarioTrabalho;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class HorarioTrabalho.
 *
 * @package namespace App\Entities\HorarioTrabalho;
 */
class HorarioTrabalho extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
