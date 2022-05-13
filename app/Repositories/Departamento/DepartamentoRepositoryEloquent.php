<?php

namespace App\Repositories\Departamento;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Departamento\DepartamentoRepository;
use App\Entities\Departamento\Departamento;
use App\Validators\Departamento\DepartamentoValidator;

/**
 * Class DepartamentoRepositoryEloquent.
 *
 * @package namespace app\Repositories\Departamento;
 */
class DepartamentoRepositoryEloquent extends BaseRepository implements DepartamentoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Departamento::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
