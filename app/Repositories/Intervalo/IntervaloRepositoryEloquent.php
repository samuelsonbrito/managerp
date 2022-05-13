<?php

namespace App\Repositories\Intervalo;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Intervalo\IntervaloRepository;
use App\Entities\Intervalo\Intervalo;
use App\Validators\Intervalo\IntervaloValidator;

/**
 * Class IntervaloRepositoryEloquent.
 *
 * @package namespace App\Repositories\Intervalo;
 */
class IntervaloRepositoryEloquent extends BaseRepository implements IntervaloRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Intervalo::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
