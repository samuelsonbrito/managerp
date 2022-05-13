<?php

namespace App\Repositories\Dependente;

use App\Models\Dependente;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class DependenteRepositoryEloquent extends BaseRepository implements DependenteRepository
{
    public function model()
    {
        return Dependente::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $data)
    {

        $data = collect($data)->map(function ($value) {
            $value = mb_strtoupper($value);
            if ($value == "") {
                $value = null;
            }

            return $value;
        });

        $data = $data->toArray();
        $dependente = $this->makeModel()->create($data);

        return $dependente;
    }
    
}
