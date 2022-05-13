<?php

namespace App\Repositories\ColaboradorConselhoProfissional;

use App\Models\ColaboradorConselhoProfissional;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class ColaboradorConselhoProfissionalRepositoryEloquent extends BaseRepository implements ColaboradorConselhoProfissionalRepository
{

    public function model()
    {
        return ColaboradorConselhoProfissional::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
