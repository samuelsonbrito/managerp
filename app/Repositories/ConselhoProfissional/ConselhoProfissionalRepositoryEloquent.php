<?php

namespace App\Repositories\ConselhoProfissional;

use App\Models\ConselhoProfissional;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class ConselhoProfissionalRepositoryEloquent extends BaseRepository implements ConselhoProfissionalRepository
{

    public function model()
    {
        return ConselhoProfissional::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getConselhos()
    {
        $conselhos = $this->all(['id', 'nome'])->toArray();
        $conselhos = array_column($conselhos, 'nome', 'id');

        return $conselhos;
    }
}
