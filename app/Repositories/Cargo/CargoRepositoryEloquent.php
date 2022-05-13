<?php

namespace App\Repositories\Cargo;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Cargo\CargoRepository;
use App\Entities\Cargo\Cargo;
use App\Validators\Cargo\CargoValidator;

/**
 * Class CargoRepositoryEloquent.
 *
 * @package namespace App\Repositories\Cargo;
 */
class CargoRepositoryEloquent extends BaseRepository implements CargoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cargo::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
