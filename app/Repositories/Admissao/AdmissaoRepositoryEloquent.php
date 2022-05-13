<?php

namespace App\Repositories\Admissao;

use App\Models\Admissao;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class AdmissaoRepositoryEloquent extends BaseRepository implements AdmissaoRepository
{

    public function model()
    {
        return Admissao::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
