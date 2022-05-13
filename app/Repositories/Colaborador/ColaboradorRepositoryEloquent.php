<?php

namespace App\Repositories\Colaborador;

use App\Models\Colaborador;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class ColaboradorRepositoryEloquent extends BaseRepository implements ColaboradorRepository
{

    public function model()
    {
        return Colaborador::class;
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
        $colaborador = $this->makeModel()->create($data);
        $colaborador = empty(@$data['matricula']) ? $this->updateMatricula($colaborador) : $colaborador;

        return $colaborador;
    }

    private function updateMatricula($colaborador)
    {
        $colaborador = $this->find($colaborador->id);
        return $this->update(['matricula' => uniqid()], $colaborador->id);
    }


}
