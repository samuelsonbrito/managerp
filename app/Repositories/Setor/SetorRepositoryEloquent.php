<?php

namespace App\Repositories\Setor;

use App\Models\Setor;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class SetorRepositoryEloquent extends BaseRepository implements SetorRepository
{
    public function model()
    {
        return Setor::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
