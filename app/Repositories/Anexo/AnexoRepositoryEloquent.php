<?php

namespace App\Repositories\Anexo;

use App\Models\Anexo;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class AnexoRepositoryEloquent extends BaseRepository implements AnexoRepository
{

    public function model()
    {
        return Anexo::class;
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
        $anexo = $this->makeModel()->create($data);

        return $anexo;
    }

}
