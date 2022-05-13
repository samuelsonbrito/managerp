<?php

namespace App\Repositories\HorarioTrabalho;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\HorarioTrabalho\HorarioTrabalhoRepository;
use App\Entities\HorarioTrabalho\HorarioTrabalho;
use App\Validators\HorarioTrabalho\HorarioTrabalhoValidator;

/**
 * Class HorarioTrabalhoRepositoryEloquent.
 *
 * @package namespace App\Repositories\HorarioTrabalho;
 */
class HorarioTrabalhoRepositoryEloquent extends BaseRepository implements HorarioTrabalhoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return "App\\Models\\HorarioTrabalho";
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
