<?php

namespace App\Repositories\Cliente;

use App\Models\Cliente;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class ClienteRepositoryEloquent extends BaseRepository implements ClienteRepository
{

    public function model()
    {
        return Cliente::class;
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
        $cliente = $this->makeModel()->create($data);

        return $cliente;
    }
    
}
