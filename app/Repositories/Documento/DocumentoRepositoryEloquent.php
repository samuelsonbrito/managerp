<?php

namespace App\Repositories\Documento;

use App\Models\Documento;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class DocumentoRepositoryEloquent extends BaseRepository implements DocumentoRepository
{
    public function model()
    {
        return Documento::class;
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
        $documento = $this->makeModel()->create($data);

        return $documento;
    }
    
}
