<?php

namespace App\Repositories\ColaboradoHTrabalhoIntervalo;

use App\Models\ColaboradorHorarioTrabalhoIntervalo;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class ColaboradorHTrabalhoIntervaloRepositoryEloquent extends BaseRepository implements ColaboradorHTrabalhoIntervaloRepository
{

    public function model()
    {
        return ColaboradorHorarioTrabalhoIntervalo::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $dados)
    {
        $response = $this->makeModel()->create($dados);
        return $response;
    }
}
